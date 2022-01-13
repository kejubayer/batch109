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
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($carts as $cart)
                        <tr>
                            <td>{{$cart['name']}}</td>
                            <td>{{$cart['price']}}</td>
                            <td>{{$cart['quantity']}}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
