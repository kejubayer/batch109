@extends('layouts.frontend')
@section('main')
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h3 class="text-center mt-3">Your Cart!</h3>
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
                @if(count($carts)>0)
                    <a href="{{route('checkout')}}" class="btn btn-primary">Place order</a>
                @else
                    <a href="{{route('home')}}" class="btn btn-warning">Continue Shopping</a>
                @endif
            </div>
        </div>
    </div>
@endsection
