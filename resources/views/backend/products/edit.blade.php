@extends('layouts.backend')

@section('main')

    <div class="row">
        <h3 class="text-center mt-3">Update Product</h3>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form action="{{route('admin.product.edit',$product->id)}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Inter Product Name" value="{{$product->name}}" >
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Product Price</label>
                    <input type="number" name="price" class="form-control" id="price" placeholder="Inter Product Price" value="{{$product->price}}">
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Description</label>
                    <textarea name="desc" class="form-control" id="desc" placeholder="Inter Product Description" rows="5">{{$product->desc}}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>





@endsection
