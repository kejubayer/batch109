@extends('layouts.frontend')
@section('main')
    <div class="container">
        <div class="row mt-3">
            <h2 class="text-center">Order Details</h2>
            <div class="col-md-6">
                <h3 class="text-center">Customer Information</h3>
                <p><strong>Customer Name: </strong>{{$order->name}}</p>
                <p><strong>Customer phone: </strong>{{$order->phone}}</p>
                <p><strong>Customer address: </strong>{{$order->address}}</p>
                <p><strong>Total Price: </strong>{{$order->price}}</p>
                <p><strong>Total Quantity: </strong>{{$order->qty}}</p>
                <p><strong>Status: </strong>{{$order->status}}</p>
                <p><strong>Payment Method: </strong>{{$order->payment_method}}</p>
                <p><strong>Txn ID: </strong>{{$order->txn_id}}</p>
                <p><strong>Order Date: </strong>{{$order->created_at->format('d M, Y')}}</p>
            </div>
            <div class="col-md-6">
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
                    @foreach($order->details as $details)
                        <tr>
                            <td>{{$details->name}}</td>
                            <td>{{$details->price}}</td>
                            <td>{{$details->qty}}</td>
                            <td>{{$details->price * $details->qty}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <th>{{$order->price}}</th>
                        <th>{{$order->qty}}</th>
                    </tr>

                    </tbody>
                </table>
                <a href="{{route('profile')}}" class="btn btn-primary">Back To Profile</a>
            </div>
        </div>
    </div>
@endsection
