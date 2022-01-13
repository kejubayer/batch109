@extends('layouts.frontend')
@section('main')
    <div class="container">
        <div class="row mt-3">
            <h3 class="text-center">Your Profile!</h3>
            <div class="col-md-6">
                <img src="{{asset('uploads/users/'.auth()->user()->photo)}}" alt="{{auth()->user()->name}}" width="200px">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{route('profile')}}" method="post" enctype="multipart/form-data">
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
                        <input type="email" class="form-control" value="{{auth()->user()->email}}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Profile Picture</label>
                        <input type="file" name="photo" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>

@endsection
