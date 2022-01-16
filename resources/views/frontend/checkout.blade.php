@extends('layouts.frontend')
@section('main')
    <div class="container">
        <div class="row mt-3">
            <h3 class="text-center">Please Checkout!</h3>
            <div class="col-md-6">
                <h3 class="text-center">Your Cart!</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Product Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $totalPrice = 0;
                        $totalQty = 0;
                    @endphp
                    @foreach($carts as $cart)
                        <tr>
                            <td>{{$cart['name']}}</td>
                            <td>{{$cart['price']}} <span
                                    style="font-size: 20px;font-weight: bold">৳</span></td>
                            <td>{{$cart['quantity']}}</td>
                            <td>{{$cart['price'] * $cart['quantity']}} <span
                                    style="font-size: 20px;font-weight: bold">৳</span></td>
                        </tr>
                        @php
                            $totalQty += $cart['quantity'];
                            $totalPrice += $cart['price'] * $cart['quantity'];
                        @endphp
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <th>{{$totalQty}}</th>
                        <th>{{$totalPrice}} <span
                                style="font-size: 20px;font-weight: bold">৳</span></th>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <h3 class="text-center">User Information!</h3>
            @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
                <form action="{{route('checkout')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" value="{{auth()->user()->name}}" id="name" >
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control" value="{{auth()->user()->phone}}" id="phone" >
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea name="address" id="address" class="form-control">{{auth()->user()->address}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" value="{{auth()->user()->email}}" id="exampleInputEmail1">
                    </div>
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Payment Method</label>
                        <select name="payment_method" id="payment_method" class="form-control">
                            <option value="Bkash">Bkash</option>
                            <option value="Nagod">Nagod</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="txn_id" class="form-label">Txn ID</label>
                        <input type="text" name="txn_id" class="form-control" id="txn_id">
                    </div>
                    <input type="hidden" name="price" value="{{$totalPrice}}">
                    <input type="hidden" name="qty" value="{{$totalQty}}">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

@endsection
