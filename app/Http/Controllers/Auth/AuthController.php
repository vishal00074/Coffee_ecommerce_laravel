<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\{User_Address, Order};
use Session,URL, Hash;
use Illuminate\Support\Facades\Validator;
use Redirect;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function AuthRegister(Request $request)
    {
        return view('auth.Register');
    }
    
    public function AuthLogin(Request $request)
    {
        return view('auth.login');
    }


    public function Registration(Request $request)
    {
        $validateUser = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email',
                'password' =>  [
                    'required',
                    'string',  
                ],
                'password_confirmation' => 'required|same:password',
            ]

        );

        if ($validateUser->fails()) {
            return Redirect::back()->withErrors($validateUser->errors());
        }


        $code = mt_rand(1111, 9999);
        $message = "Your Registration code is" . $code;

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['verification_time'] =  date('Y-m-d H:i:s', strtotime('2 minute'));
        $input['code']=   $code;

        /** Is User Already Existed  */
        $is_verified =User::where('email', $request->email)->where('is_verified', '1')->first();
        if($is_verified){
            return redirect()->back()->with('error', 'User email already registred');
        }


        /**   Is user already In Database but not verified */
        $is_exist =User::where('email', $request->email)->where('is_verified', '0')->first();

        if(!empty($is_exist)){
            $is_exist->name = $request->name;
            $is_exist->password = bcrypt($input['password']);
            $is_exist->verification_time =  date('Y-m-d H:i:s', strtotime('2 minute'));
            $is_exist->code =$code;
            $is_exist->update();
            $data['name'] = $is_exist->name;
            $data['email'] = $is_exist->email;
            $data['title'] = "Welcome to Coffee Web Application";
            $data['body']  = "You have successfully registered in Coffee web application";
            $data['otp']  = $code;
    
            \Mail::send('email.welcomeemail', ['data' => $data], function ($message) use ($data) {
                $message->to($data['email'])->subject($data['title']);
            });
    
            return redirect()->route('otp.verification', ['id' => $is_exist->id])->with('success', 'otp has sent to your email');
         
        }
        /**     Is user new     */
        else{
            $user = User::create($input);
            $data['name'] = $user->name;
            $data['email'] = $user->email;
            $data['title'] = "Welcome to Coffee Web Application";
            $data['body']  = "You have successfully registered in Coffee web application";
            $data['otp']  = $code;
    
            \Mail::send('email.welcomeemail', ['data' => $data], function ($message) use ($data) {
                $message->to($data['email'])->subject($data['title']);
            });
       
            return redirect()->route('otp.verification', ['id' => $user->id])->with('success', 'otp has sent to your email');
        }
    }


    public function Otp(Request $request, $id)
    {
        return view('auth.otp', compact('id'));
    }


    public function SubmitOtp(Request $request)
    {
        $validateUser = Validator::make(
            $request->all(),
            [
                'code' => 'required',
                'id'=> 'required'
            ]
        );
        if ($validateUser->fails()) {
            return Redirect::back()->withErrors($validateUser->errors());
        }
        
        $verify_user = User::where('id', $request->id)->where('code', $request->code)->first();
        if ($verify_user) {
            if (date('Y-m-d H:i:s') <= $verify_user->verification_time) {
                $users = User::where('id', $request->id)->first();
                $users->is_verified = '1';
                $users->update();
                
                Session::flash('success','Verified Successfully...Please login');
                return redirect()->route('user.login');
            }
            else {
                return Redirect::back()->with('error','Verification code has been expired');
            }
        }
        else {
            return Redirect::back()->with('error','Verification code is not valid');
        }
    }

    public function ResendOtp($id)
    {
        $code = mt_rand(1111, 9999);
        $user = User::where('id', $id)->first();
        
        if($user){
            $data['name'] = $user->name;
            $data['email'] = $user->email;
            $data['title'] = "Welcome to Coffee Web Application";
            $data['body']  = "You have successfully registered in Coffee web application";
            $data['otp']  = $code;
    
            \Mail::send('email.welcomeemail', ['data' => $data], function ($message) use ($data) {
                $message->to($data['email'])->subject($data['title']);
            });
            $user->code =$code;
            $user->verification_time =  date('Y-m-d H:i:s', strtotime('2 minute'));
            $user->update();

            return redirect()->back()->with('success', 'New Otp has been sent successfully');
        }
        else{
            return redirect()->back()->with('error', 'Opps! Something went wrong');
        }
    }

    public function LoggedIn(Request $request)
    {
        $validateUser = Validator::make(
            $request->all(),
            [
                'email' => 'required',
                'password' => 'required',
            ]
        );

        if ($validateUser->fails()) {
            return Redirect()->back()->with('error', 'Please enter login credentials');
            // return Redirect::back()->withErrors($validateUser->errors());
        }
       

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $customer = User::where('email', $request->email)->where('is_verified', '1')->first();
            if ($customer) {
                return redirect()->intended('/')
                    ->withSuccess('Signed in');
            }
            else {
                return redirect()->back()->with('error', 'User not Verified');
            }
        }
        
        return redirect()->back()->with('error', 'Login details are not valid');
    }
    
    
    public function SignOut()
    {
        if (!Auth::guest()) {
            Session::flush();
            Auth::logout();
            return Redirect('/')->with('success', 'Signout successfully');
        }
        else {
            return Redirect()->back();
        }
    }


    public function Profile(Request $request)
    {
        $id = Auth::id();
        $data = User::where('id',$id)->first();
        $address = User_Address::where('user_id',$id)->first();
        $orders =\DB::table('orders')
        ->join('products', 'orders.product_id', '=', 'products.id')
        ->select('orders.*', 'products.name as product_name', 'products.image as product_image')
        ->where('user_id', $id)
        ->get();
        return view('auth.profile', compact('data','address','orders'));
    }
    
    
    
    public function UpdateProfile(Request $request, $id){
        try{
            if(!empty($request->profile)){
                $data = $request->only('name','email');
                $user = User::find($id);
                
                if(!empty($request->password)){
                    if($user && !Hash::check($request->current_password, $user->password)){
                        return redirect()->back()->with('error','Password not matched!!');
                    }
                    
                    $data['password'] = Hash::make($request->password);
                }
                
                $user->update($data);
                return redirect()->back()->with('success','Successfully updated profile details!!');
            }
            
            
            if(!empty($request->myaddress)){
                if(User_Address::where('user_id',$request->user_id)->exists()){
                    User_Address::where('user_id',$request->user_id)->update([
                        'user_id' => $request->user_id,
                        'house_no' => $request->house_no,
                        'city' => $request->city,
                        'state' => $request->state,
                        'country' => $request->country,
                        'landmark' => $request->landmark,
                        'pincode' => $request->pincode,
                        'phone' => $request->phone,
                        'shipping_name' => $request->shipping_name,
                        'shipping_email' => $request->shipping_email
                    ]);
                    
                    return redirect()->back()->with('success','Successfully updated adress details!!');
                }else{
                    User_Address::insert([
                        'user_id' => $request->user_id,
                        'house_no' => $request->house_no,
                        'city' => $request->city,
                        'state' => $request->state,
                        'country' => $request->country,
                        'landmark' => $request->landmark,
                        'pincode' => $request->pincode,
                        'phone' => $request->phone,
                        'shipping_name' => $request->shipping_name,
                        'shipping_email' => $request->shipping_email
                    ]);
                    
                    return redirect()->back()->with('success','Successfully created adress details!!');
                }
            }
        }
        catch(\Exception $e){
            Session::flash('error', $e->getMessage()); 
            return redirect()->back();
        }
    }
    
    
    public function OrderDetail($id){
        $data = \DB::table('products')
                ->select('products.*')
                ->where('products.id',$id)
                ->first();
                
        $order_data = \Db::table('orders')
                ->select('orders.*')
                ->where('orders.product_id',$id)
                ->where('user_id',Auth::user()->id)
                ->first();
            
            $order_data->product_name = $data->name;
            $order_data->product_image = $data->image;
        // dd($order_data,$data);
        return view('order_detail', compact('data','order_data'));
    }
    
    
    
    
    
    /**-----   Forget-Password   -----*/
    public function Forget_Password(Request $request)
    {
        return view('auth.forget_password');
    }
    
    public function SubmitRequest(Request $request)
    {
        try{
            $users = User::where('email', $request->email)->get();
            
            foreach($users as $user){
                $username = $user->name;
            }
    
            if(count($users) > 0)
            {
                $random= Str ::random(40);
                $domain= URL::to('/');
    
                $url = $domain.'/forget-password?token='.$random;
                
                // Mail_____________________________________________________________
                $data['url'] = $url;
                $data['email'] =$request->email;
                $data['title'] ="Reset Your Password";
                $data['app'] = "Coffee Web Application";
                $data['username']= $username;
                
                $mail= \Mail::send('email.Verify', ['data'=>$data],function($message) use ($data){
                    $message->to($data['email'])->subject($data['title']); 
                });
    
                $users =User::find($users[0]['id']); 
                $users->remember_token = $random;
                $users->save();
                 
                return redirect("/login")->with('success','Reset Link Has been sent in your email');
            }
            else{
                return redirect()->back()->with('error','Email not found');
            }
        }
        catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
    
    public function verificationMail(Request $request)
    {
        // dd($request->all());
       try{
            $users= User::where('remember_token', $request->token)->first();
            // dd($users);
            if(!empty($users) || $users!=null) {
                $is_token= User::where('remember_token', $request->token)->first();
                $is_token->remember_token = '';
                $is_token->update();
                $data=$users->email;
    
                if(isset($request->token) && $users){
                    $customer=User::where('email', $data)->first();
                    // dd($customer->id);
                    return view('forget_password', compact('customer'));
                }
                else {
                    return "<h1>Oops something went wrong</h1>";
                }
            }
            else{
                return "<h1>Link Expired</h1>";
            }
        }
        catch (\Throwable $th) {
            return response()->json([
                'status' => 'false',
                'message' => $th->getMessage()
            ], 200);
        }

    }

    public function ForgetPassword(Request $request)
    {
        try{
            // $validateUser = Validator::make($request->all(), 
            // [
            //     // 'id' => 'required',
            //     'password' =>  [
            //         'required',
            //         'min:6',
            //     ],
            //     'confirm_password' => 'required|same:password'
            // ]);
            // if($validateUser->fails()){
            //     // dd($validateUser->errors());
            //     return Redirect::back()->withErrors($validateUser->errors());
            // }
            // dd($request->all());
            $customers= User::where('id', $request->id)->first();
            // dd($customers);
            $customers->password =  Hash::make($request->password);
            
            $customers->update();
            
            if($customers){
                return redirect("/login")->with('success','You have successfully changed the password');
                // return "<h1>You have successfully changed the password</h1>";
            }
            else{
                return "<h1>Oops! something went wrong</h1>";
            }
        }
        catch (\Throwable $th) {
            return response()->json([
                'status' => 'false',
                'message' => $th->getMessage()
            ], 200);
        }
    }
    /**-----   End - Forget-Password  -----*/
}
