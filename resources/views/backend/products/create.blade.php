@extends('layouts.backend')

@section('main')

    <div class="row">
        <h3 class="text-center mt-3">Create New Product</h3>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            {{--  @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif--}}

            <form action="{{route('admin.product.create')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                           value="{{old('name')}}" placeholder="Inter Product Name" required>
                    @error('name')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Product Price</label>
                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                           id="price" value="{{old('price')}}" placeholder="Inter Product Price" required>
                    @error('price')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Description</label>
                    <textarea name="desc" class="form-control @error('desc') is-invalid @enderror" id="desc"
                              placeholder="Inter Product Description"
                              rows="5" required>{{old('desc')}}</textarea>
                    @error('desc')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Photo</label>
                    <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" id="photo" required>
                    @error('photo')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>





@endsection
