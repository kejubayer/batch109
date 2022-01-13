@extends('layouts.frontend')
@section('title') Home - @endsection
@section('main')

    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">{{config('app.name')}}</h1>
                <p>
                    <a href="{{route('cart')}}" class="btn btn-primary my-2">View cart</a>
                </p>
            </div>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach($products as $product)
                    <div class="col">
                        <div class="card shadow-sm">
{{--                            <img src="{{asset('uploads/products/'.$product->photo)}}" alt="" height="300px">--}}
                            <img src="{{$product->photo}}" alt="" height="300px">
                            <div class="card-body">
                                <h3>{{$product->name}}</h3>
                                <p class="card-text">{{$product->desc}}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{route('cart.add',$product->id)}}" class="btn btn-sm btn-outline-secondary">Add To Cart
                                        </a>
                                    </div>
                                    <small class="text-muted">{{$product->price}} <span
                                            style="font-size: 20px;font-weight: bold">৳</span></small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{$products->links()}}
            </div>
        </div>
    </div>

@endsection
