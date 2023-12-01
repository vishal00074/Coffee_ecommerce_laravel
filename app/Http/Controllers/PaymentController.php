<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Order,User_Address,Cart,Payment};
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Auth,Session,Stripe;
use Stripe\PaymentIntent;   

class PaymentController extends Controller
{
    public function GetStripe(Request $request){
        // dd($request);
        if(empty($request->product_id)){
            return redirect()->back()->with('error', 'Cart is empty !!');
        }
        
        if(Auth::guest()){
            $guestId = Session::get('guest_id');
            $user_address = User_Address::where('user_id',$guestId)->first();
            
            $address = [
                'user_id'=>$guestId,
                'house_no'=>$request->house_no,
                'city'=>$request->city,
                'state'=>$request->state,
                'country'=>$request->country,
                'landmark'=>$request->landmark,
                'pincode'=>$request->pincode,
                'phone'=>$request->phone,
                'shipping_name'=>$request->shipping_name,
                'shipping_email'=>$request->shipping_email,
            ];
            
            if($user_address){
                $user_address->update($address);
            }else{
                User_Address::insert($address);
            }
            $amount = $request->total;
            $total_amount = array_sum($amount);
            $order_id = uniqid('CBDCoffee_');
            
            if($request->paymentmethod=='stripe'){
                return redirect()->route('guest.stripe', ['total_amount' => $total_amount]);
            }
        }else{
            $userID = auth()->user()->id;
            $user_address = User_Address::where('user_id', $userID)->first();
                
                /**_________ ADD/UPDATE USER ADDRESS ____________*/
                $address = [
                        'user_id'=>$userID,
                        'house_no'=>$request->house_no,
                        'city'=>$request->city,
                        'state'=>$request->state,
                        'country'=>$request->country,
                        'landmark'=>$request->landmark,
                        'pincode'=>$request->pincode,
                        'phone'=>$request->get('phone'),
                        'shipping_name'=>$request->get('shipping_name'),
                        'shipping_email'=>$request->shipping_email,
                ];
                // dd($address);
                if($user_address){
                    $user_address->update($address);
                }else{
                    User_Address::insert($address);
                }
                $amount = $request->total;
                $total_amount = array_sum($amount);
                $order_id=  uniqid('CBDCoffee_');
                // dd($total_amount, $order_id);
                /**_________Onilne Payment ____________*/
                if($request->paymentmethod=='stripe'){
                    
                    return redirect()->route('stripe', ['total_amount' => $total_amount]);
                }
        }
    }
    
    public function AuthStripe(Request $request){
        $total_amount = $request->query('total_amount');
        return view('stripe', compact('total_amount'));
    }
    
    public function GuestStripe(Request $request){
        $total_amount = $request->query('total_amount');
        return view('stripe', compact('total_amount'));
    }
    
    public function StripePost(Request $request){
        if(Auth::user() == true){
            $userID = Auth::user()->id;
            $orders = Cart::where('user_id',$userID)->get();
     
            if(empty($orders)){
                return redirect()->back()->with('error', 'You have no product added in cart');
            }
            
            try{
                Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                
                $response = Stripe\Charge::create([
                        'amount' => $request->ammout * 100,
                        'currency' => 'GBP',
                        'source' => $request->stripeToken,
                        "description" => "User Payment." 
                    ]);
                    
                if($response->status = "succeeded"){
                    $response->amount = intval($response->amount)/100;
                    $order_id = uniqid('CBDCoffee_');
                    $order_array=[];
                    foreach($orders as $detail){
                        $order = [
                            'product_id' => $detail->product_id,
                            'order_id' => $order_id,
                            'user_id'=> $userID,
                            'size_id'=> $detail->size_id,
                            'quantity'=> $detail->quantity,
                            'shipping' => '0',
                            'pay_type' => 'stripe',
                            'total'=> $detail->total_price,
                            ];
                          
                        Order::create($order);
                        $order_array[] =$order;
                    }
                    $payment = [
                             'transaction_id' => $response->id,
                             'amount' =>$response->amount,
                             'receipt_url' => $response->receipt_url,
                             'status' => $response->status,
                             'order_id' => $order_id,
                             'user_id' => $userID
                            ];
                    Payment::create($payment);
                    $this->AuthPaymentEnvoice($order_array, $payment);
                    $deletes = Cart::where('user_id',$userID)->get();
                    foreach($deletes as $delete){
                        $delete->delete();
                    }
                    //  dd($delete);
                    return redirect('thankyou')->with('success', 'Payment has been received successfully!'); 
                }
                else{
                    return redirect()->back()->with('error', 'Payment Failed');
                }
            }
            catch (\Exception $e) {
                Session::flash('error',$e->getMessage());
                return redirect()->back();
            }
        }else{
            $guestId = Session::get('guest_id');
            $orders = Cart::where('user_id',$guestId)->get();
    
            if(empty($orders)){
                return redirect()->back()->with('error', 'You have no product added in cart');
            }
            
            try{
                Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                
                $response = Stripe\Charge::create([
                        'amount' => $request->ammout * 100,
                        'currency' => 'GBP',
                        'source' => $request->stripeToken,
                        "description" => "User Payment." 
                    ]);
                if($response->status = "succeeded"){
                    $response->amount = intval($response->amount)/100;
                    $order_id = uniqid('CBDCoffee_');
                    $order_array=[];
                    foreach($orders as $detail){
                        $order = [
                            'product_id' => $detail->product_id,
                            'order_id' => $order_id,
                            'user_id'=> $guestId,
                            'size_id'=> $detail->size_id,
                            'quantity'=> $detail->quantity,
                            'shipping' => '0',
                            'pay_type' => 'stripe',
                            'total'=> $detail->total_price,
                            ];
                        Order::create($order);
                        $order_array[] =$order;
                    }
                    
                    $payment = [
                             'transaction_id' => $response->id,
                             'amount' =>$response->amount,
                             'receipt_url' => $response->receipt_url,
                             'status' => $response->status,
                             'order_id' => $order_id,
                             'user_id' => $guestId
                            ];
                    Payment::create($payment);
                     $this->GuestPaymentEnvoice($order_array, $payment);
                     $delete = Cart::where('user_id',$guestId)->delete();
                    //  dd($delete);
                    return redirect('thankyou')->with('success', 'Payment has been received successfully!'); 
                }
                else{
                    return redirect()->back()->with('error', 'Payment Failed');
                }
            }
            catch (\Exception $e) {
                Session::flash('error',$e->getMessage());
                return redirect()->back();
            }
        }
    }
    
    public function AuthPaymentEnvoice($order_array, $payment){
        // dd($order_array, $payment);
        $userId = $order_array[0]['user_id'];
        $shipping = $order_array[0]['shipping'];
        $cutomer_address = \DB::table('user_address')->where('user_id', $userId)->select('*')->first();
        
        $carts = \DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select('carts.*','products.*')
            ->where('user_id', $userId)
            ->get();
             foreach($carts as $cart)
            {
                $cart->total_price = $cart->total_price * $cart->quantity;
                $size = \DB::table('sizes')
                    ->join('carts','carts.size_id','=','sizes.id')
                    ->select('sizes.name as size_name')
                    ->where('sizes.id',$cart->size_id)
                    ->first();
                    
                   $cart->size_name =  $size->size_name;
               $price = \DB::table('product_details')
                    ->join('products','products.id','=','product_details.product_id')
                    ->select('product_details.price as price','product_details.discounted as discounted')
                    ->where('product_details.product_id',$cart->product_id)
                    ->first();
                $cart->price = $price->price;
                $cart->discounted_price = $price->discounted;
            }
            
            $total = $carts->sum('total_price') + intval($shipping);
            
            // dd($carts,$total,$order_array,$cutomer_address, $payment );
            
            $mail = \Mail::send('email.auth_invoice', ['carts' => $carts,'total' => $total, 'order_array' => $order_array, 'cutomer_address' => $cutomer_address, 'payment' => $payment], function ($message) use ($cutomer_address) {

              $message->to($cutomer_address->shipping_email)->subject('Your Order details');
            });
    }
    
    public function GuestPaymentEnvoice($order_array, $payment){
        $userId = $order_array[0]['user_id'];
        $shipping = $order_array[0]['shipping'];
        $cutomer_address = \DB::table('user_address')->where('user_id', $userId)->select('*')->first();
        
        $carts = \DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select('carts.*','products.*')
            ->where('user_id', $userId)
            ->get();
             foreach($carts as $cart)
            {
                $cart->total_price = $cart->total_price * $cart->quantity;
                $size = \DB::table('sizes')
                    ->join('carts','carts.size_id','=','sizes.id')
                    ->select('sizes.name as size_name')
                    ->where('sizes.id',$cart->size_id)
                    ->first();
                    
                   $cart->size_name =  $size->size_name;
               $price = \DB::table('product_details')
                    ->join('products','products.id','=','product_details.product_id')
                    ->select('product_details.price as price','product_details.discounted as discounted')
                    ->where('product_details.product_id',$cart->product_id)
                    ->first();
                $cart->price = $price->price;
                $cart->discounted_price = $price->discounted;
            }
            
            $total = $carts->sum('total_price') + intval($shipping);
            
            // dd($carts,$total,$order_array,$cutomer_address, $payment );
            
            $mail = \Mail::send('email.auth_invoice', ['carts' => $carts,'total' => $total, 'order_array' => $order_array, 'cutomer_address' => $cutomer_address, 'payment' => $payment], function ($message) use ($cutomer_address) {

              $message->to($cutomer_address->shipping_email)->subject('Your Order details');
            });
    }
    
}
