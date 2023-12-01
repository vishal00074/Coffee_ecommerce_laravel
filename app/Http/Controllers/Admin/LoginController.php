<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use Hash;

class LoginController extends Controller
{
    public function login(){
        // dd(Hash::make('coffee@123'));
        return view('admin.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(auth()->guard('admin')->attempt(['email' => $request->input('email'),  'password' => $request->input('password')])){
            $user = auth()->guard('admin')->user();
            if($user->is_admin == 1){
                return redirect()->route('adminDashboard')->with('success','You are Logged in sucessfully.');
            }
        }else {
            return back()->with('error','Whoops! invalid email and password.');
        }
    }

    public function adminLogout(Request $request)
    {
        auth()->guard('admin')->logout();
        Session::flush();
        Session::put('success', 'You are logout sucessfully');
        return redirect(route('adminLogin'));
    }
    
    
    
    
    
    
    //PROFILE***************************************
    public function profile(){
        $profile = Admin::first();
        return view('admin.profile',compact('profile'));
    }

    public function profile_post(Request $request)
    {
        try{
            $data = $request->except('_token','cpassword','id','password');
            
            if(!empty($request->get('password'))){
                $data['password'] = Hash::make($request->get('password'));
            }
            
            //image____________________
            if($request->file('logo')){
                $name = $request->file('logo')->getClientOriginalName();
                $request->file('logo')->move(public_path('assets/admin/img'), $name);
                $data['logo'] = url('public/'.'assets/admin/img/'.$name);
            }
            
            Admin::where('id',$request->get('id'))->update($data);
            Session::flash('success','Successfully updated profile settings!!');
            return redirect()->back();
        }
        catch(\Exception $e){
            Session::flash('error',$e->getMessage());
            return redirect()->back();
        }
    }
    //END-PROFILE***********************************
}