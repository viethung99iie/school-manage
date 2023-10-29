<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Str;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class AuthController extends Controller
{
    public function index(){
        if (Auth::check()) {
            if(Auth::user()->user_type === 1){
                 return redirect('admin/dashboard');
            }
            if(Auth::user()->user_type === 2){
                 return redirect('teacher/dashboard');
            }
            if(Auth::user()->user_type === 3){
                 return redirect('student/dashboard');
            }
            if(Auth::user()->user_type === 4){
                 return redirect('parent/dashboard');
            }
        }
         return view('auth.login');
    }

    public function authLogin(Request $request){
        $email  = $request->email;
        $password = $request->password;
        $remember = $request->remember?true:false;
       if(Auth::attempt(['email' => $email, 'password' => $password],$remember)){
            if(Auth::user()->user_type === 1){
                 return redirect('admin/dashboard');
            }
            if(Auth::user()->user_type === 2){
                 return redirect('teacher/dashboard');
            }
            if(Auth::user()->user_type === 3){
                 return redirect('student/dashboard');
            }
            if(Auth::user()->user_type === 4){
                 return redirect('parent/dashboard');
            }
       }
       return redirect()->back()->withInput()->with('danger','Sai tài khoản hoặc mật khẩu');
    }
    public function logOut(){
        Auth::logOut();
        return redirect()->route('login')->with('success','Đăng xuất thành công!!');
    }
    public function forgot(){
        return view('auth.forgot');
    }
    public function checkForgot(Request $request){
        $user = User::singelEmail($request->email);
        if(!empty($user)){
            $user->remember_token = Str::random(30);
            $user->save();
            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            return redirect()->back()->with('success','Vui lòng kiểm tra email!');
        }
        return redirect()->back()->with('danger','Không tìm thấy email trong hệ thống!')->withInput();
    }
    public function reset($token){
        $user = User::SingelToken($token);
        if(!empty($user)){
            return view('email.forgot-password',compact('token'));
        }
        return abort(404);
    }
    public function postReset($token,Request $request){
        $user = User::singelToken($token);
        if(!empty($user) && $request->password===$request->confirm){
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('login')->with('success','Thay đổi mật khẩu thành công!!');
        }
         return abort(404);
}

}