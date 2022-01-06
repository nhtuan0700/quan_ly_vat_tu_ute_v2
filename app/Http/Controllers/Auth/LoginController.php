<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Login\LoginRequest;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $crendentials = $request->only('email', 'password');
        $bool = $request->has('remember') ? true : false;
        if (Auth::attempt($crendentials, $bool)) {
            if (auth()->user()->is_disabled) {
                Auth::logout();
                return back()->with('alert-fail', 'Tài khoản đã bị khóa');
            }
            return redirect(route('index'));
        }
        return back()->with('alert-fail', trans('auth.failed'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }
}
