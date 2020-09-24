@extends('layouts.admin')
@section('content')


    <div class="col-md-12">
        <!-- general form elements disabled -->
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title text-uppercase">{{$action." ".$title}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="post" action="{{$route}}@if(isset($data)){{"/".$data->id }}@endif"
                      enctype="multipart/form-data">
                    @csrf
                    @if(isset($data))
                        @method("PUT")
                    @endif

                    <div class="form-group">
                        <label>Name</label>
                        @error('name')
                        <p class="text-danger" role="alert">
                            <i class="far fa-times-circle"></i>
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               placeholder=" Name ..." value="{{ $data->name ?? old('name')}}">
                    </div>

                    <div class="form-group">
                        <label>Price</label>
                        @error('price')
                        <p class="text-danger" role="alert">
                            <i class="far fa-times-circle"></i>
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                        <input type="number" step="any" name="price" class="form-control @error('price') is-invalid @enderror"
                               placeholder=" Price ..." value="{{ $data->price ?? old('price')}}">
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        @error('description')
                        <p class="text-danger" role="alert">
                            <i class="far fa-times-circle"></i>
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                        <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"
                               placeholder="Description ..." value="{{ $data->description ?? old('description')}}">
                    </div>

                    <button type="submit" class="btn btn-success col-md-12">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
