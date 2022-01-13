<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate->getMessageBag());
        }
        $creds = $request->except('_token');
      /*  if (\auth()->attempt($creds)) {
            if (\auth()->user()->role == 'admin'){
                return redirect()->route('dashboard');
            }
            return redirect()->route('home');
        }else{
            return redirect()->back();
        }*/
        if (Auth::attempt($creds)) {
            if (Auth::user()->role == 'admin'){
                return redirect()->route('dashboard');
            }
            Session::flash('message',"Login successful!");
            Session::flash('alert','success');
            return redirect()->route('home');
        }else{
            Session::flash('message',"Email/Password wrong!");
            Session::flash('alert','danger');
            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::logout();
        Session::flash('message',"Logout successful!");
        Session::flash('alert','danger');
        return redirect()->route('home');
    }
}
