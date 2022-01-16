<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function doRegister(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'name' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
            ]);
            if ($validate->fails()) {
                return redirect()->back()->withInput()->withErrors($validate->getMessageBag());
            }
            $inputs = [
                'name'=>$request->input('name'),
                'phone'=>$request->input('phone'),
                'address'=>$request->input('address'),
                'email'=>$request->input('email'),
                'password'=>Hash::make($request->input('password')),
            ];
            User::create($inputs);
            Session::flash('message',"Registration Successful!");
            Session::flash('alert','success');
            return redirect()->route('login');
        }catch (\Exception $exception){
            Session::flash('message',$exception->getMessage());
            Session::flash('alert','danger');
            return redirect()->back();
        }
    }

    public function profile()
    {
        $orders = Order::where('user_id',auth()->user()->id)->orderBy('id','desc')->get();
        return view('frontend.profile',compact('orders'));
    }

    public function updateProfile(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'photo' => 'image',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate->getMessageBag());
        }
        $user = auth()->user();
        $inputs = [
            'name'=>$request->input('name'),
            'phone'=>$request->input('phone'),
            'address'=>$request->input('address'),
        ];
        $photo = $request->file('photo');
        if ($photo){
            if (file_exists('uploads/users/'.$user->photo)){
                unlink('uploads/users/'.$user->photo);
            }
            $newName = 'user_'.time().'.'.$photo->getClientOriginalExtension();
            $photo->move('uploads/users',$newName);
            $inputs['photo'] = $newName;
        }
        $user->update($inputs);
        Session::flash('message','Profile update!');
        Session::flash('alert','success');
        return redirect()->back();
    }
}
