<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function checkout()
    {
        $carts = \session()->has('cart') ? \session()->get('cart') : [];
        return view('frontend.checkout', compact('carts'));
    }

    public function order(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'name' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'email' => 'required|email',
                'payment_method' => 'required',
                'txn_id' => 'required',
                'price' => 'required',
                'qty' => 'required',
            ]);
            if ($validate->fails()) {
                return redirect()->back()->withInput()->withErrors($validate->getMessageBag());
            }
            $inputs = [
                'user_id' => auth()->user()->id,
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'email' => $request->input('email'),
                'payment_method' => $request->input('payment_method'),
                'txn_id' => $request->input('txn_id'),
                'price' => $request->input('price'),
                'qty' => $request->input('qty'),
            ];
            DB::beginTransaction();
            $order = Order::create($inputs);
            $carts = \session()->has('cart') ? \session()->get('cart') : [];
            foreach ($carts as $cart) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $cart['product_id'],
                    'name' => $cart['name'],
                    'price' => $cart['price'],
                    'qty' => $cart['quantity'],
                ]);
            }
            \session()->forget('cart');
            DB::commit();
            Session::flash('message', "Order Successful!");
            Session::flash('alert', 'success');
            return redirect()->route('profile');
        } catch (\Exception $exception) {
            DB::rollBack();
            Session::flash('message', $exception->getMessage());
            Session::flash('alert', 'danger');
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $order = Order::where('id',$id)->with('details')->first();
//        dd($order);
//        dd($order->details);
        return view('frontend.order_details',compact('order'));
    }
}
