<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\{ Cart};
use Auth;
use GuzzleHttp\Client;

class CartController extends Controller
{
    public function Cart(Request $request){
        if(Auth::guest()){
            $guestId = Session::get('guest_id');
            
            if(!$guestId){
                $guestId = uniqid('guest_');
                Session::put('guest_id', $guestId);
            }
            $carts = \DB::table('carts')
            ->join('products','products.id','=','carts.product_id')
            ->select('products.*','carts.total_price as price','carts.quantity as quantity','carts.user_id as guest_id','carts.id as cid') 
            ->where('user_id',$guestId)->orderby('id','DESC')->get();
            
            $total_price= 0;  
    
            foreach($carts as $guest_cart)
            {
                $qty_price=  $guest_cart->price * $guest_cart->quantity;
                $guest_cart->qty_price = $qty_price;
                $total_price += $qty_price;
            }
            // dd($carts,$total_price);
            return view('cart', compact('carts', 'total_price'));
        }else{
            $user_id = Auth::user()->id;
            $carts =\DB::table('carts')
            ->join('products','products.id','=','carts.product_id')
                                ->selectRaw('products.*,carts.total_price as price,carts.quantity as quantity,carts.user_id, carts.id as cid')
                                ->where('user_id',$user_id)->orderby('id','DESC')->get();
            $total_price=0;                            
            foreach($carts as $cart)
            {
                $qty_price=  $cart->price * $cart->quantity;
                $cart->qty_price = $qty_price;
                $total_price += $qty_price;
            }
            // dd($carts,$total_price); 
            return view('cart', compact('carts', 'total_price'));
        }
    }
    
    public function UpdateCart(Request $request) {
    $cids = $request->input('cid');
    $error = null;

    for ($i = 0; $i < count($cids); $i++) {
        $cid = $cids[$i];
        $cart = Cart::select('*')->where('id', $cid)->first();

        $product = \DB::table('product_details')
            ->where('product_details.product_id', $cart->product_id)
            ->select('product_details.quantity')
            ->first();

        // Check if the requested quantity is greater than the available quantity
        if ($product && $product->quantity < $request->quantity[$i]) {
            $error = 'Only ' . $product->quantity . ' products left for some items in your cart.';
            break; // Exit the loop
        }
    }

    if ($error) {
        return redirect()->back()->with('error', $error);
    } else {
        // Update the quantities if there are no errors
        for ($i = 0; $i < count($cids); $i++) {
            Cart::where('id', $cids[$i])->update(['quantity' => $request->quantity[$i]]);
        }

        return redirect()->back()->with('success', 'Cart updated successfully');
    }
}

    
    public function Add_to_cart(Request $request){
        // dd($request->all());
        if(!$request->size_id){
            return redirect()->back()->with('error', 'Please select size');
        }
        
        $is_exist = \DB::table('product_details')
        ->where('product_id',$request->product_id)
        ->where('size_id',$request->size_id)
        ->first();
        
        if($is_exist->quantity < 1){
            return redirect()->back()->with('error', 'Product out of stock'); 
        }
        if($is_exist->quantity < $request->quantity){
            return redirect()->back()->with('error', 'Only '.$is_exist->quantity.' products left'); 
        }
        if(Auth::guest()){
            $guestId = Session::get('guest_id');
            
            if(!$guestId){
                $guestId= uniqid('guest_');
                Session::put('guest_id',$guestId);
            }
            
            $cart = \DB::table('carts')
            ->where('user_id', $guestId)
            ->where('product_id', $request->product_id)
            ->where('size_id', $request->size_id)
            ->exists();
            
            if($cart){
                return redirect()->back()->with('warning', 'Product is already added in cart'); 
            }
            
            $product_details = \DB::table('product_details')
            ->select('product_details.*')
            ->where('product_details.product_id', $request->product_id)
            ->where('size_id', $request->size_id)
            ->first();
            
            if($product_details->discounted == '')
            {
                $price = $product_details->price;
            }else{
                $price = $product_details->discounted;
            }
            
            $guest_cart = new Cart;
            $guest_cart->product_id = $request->product_id;
            $guest_cart->user_id = $guestId;
            $guest_cart->quantity = $request->quantity;
            $guest_cart->total_price = $price;
            $guest_cart->size_id = $request->size_id;
            $guest_cart->save();
            
            return redirect()->back()->with('success', 'Product Added Successfully');
        }else{
            $user_id = Auth::user()->id;
        
            $cart = \DB::table('carts')
            ->where('user_id', $user_id)
            ->where('product_id', $request->product_id)
            ->where('size_id', $request->size_id)
            ->exists();
            
            if($cart){
                return redirect()->back()->with('warning', 'Product is already added in cart'); 
            }
            
            $product_details = \DB::table('product_details')
            ->select('product_details.*')
            ->where('product_details.product_id', $request->product_id)
            ->where('size_id', $request->size_id)
            ->first();
            if($product_details->discounted == '')
            {
                $price = $product_details->Price;
            }else{
                $price = $product_details->discounted;
            }
            // dd($product);
            $cart = new Cart;
            $cart->product_id = $request->product_id;
            $cart->user_id = $user_id;
            $cart->quantity = $request->quantity;
            $cart->total_price = $price;
            $cart->size_id = $request->size_id;
            $cart->save();
            
          
            
            return redirect()->back()->with('success', 'Product Added Successfully');
        }
    }
    
    public function Checkout(Request $request){
        if (Auth::guest()) {
            $guestId = Session::get('guest_id');

            if (!$guestId) {
                $guestId = uniqid('guest_');
                Session::put('guest_id', $guestId);   
            }
            
            $check_out= \DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select('carts.*', 'products.name as product_name', 'products.slug')
            ->where('user_id', $guestId)
            ->get();
            
            $grand_total = 0;
            foreach($check_out as $cart)
            {
                $qty_price=  $cart->total_price * $cart->quantity;
                $cart->single_total= $qty_price;
                $grand_total += $qty_price;
            }

            $user_address = \DB::table('user_address')->where('user_id', $guestId)->first();
            // dd($check_out,$grand_total,$user_address);
            return view('checkout',compact('check_out',  'grand_total', 'user_address'));

        }
        else{            
            $check_out= \DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select('carts.*', 'products.name as product_name', 'products.slug')
            ->where('user_id', auth()->user()->id)
            ->get();
            
            $grand_total = 0;
            foreach($check_out as $cart)
            {
                $qty_price=  $cart->total_price * $cart->quantity;
                $cart->single_total= $qty_price;
                $grand_total += $qty_price;
            }
            
            $user_address = \DB::table('user_address')->where('user_id', auth()->user()->id)->first();
            
            return view('checkout',compact('check_out',  'grand_total', 'user_address'));
        }
    }
    
    public function Cart_Remove($id){
         Cart::find($id)->delete();
        return redirect()->back()->with('success','Record removed successfully.');
    }
}
