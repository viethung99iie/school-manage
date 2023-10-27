<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if(empty(Auth::check())){
        Auth::logout();
        return redirect()->route('login');
       }
       if(Auth::user()->user_type !==2){
        Auth::logout();
        return redirect()->route('login');
       }

        return $next($request);
    }
}