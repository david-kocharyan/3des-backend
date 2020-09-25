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
                <form method="post" action="{{$route."/".$data->id }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method("PUT")

                    <h3 class="pt-3 pb-3">Country` <span class="text-danger">{{$data->country->name}}</span>, State` <span class="text-danger">{{$data->state->name}}</span></h3>

                    <div class="form-group">
                        <label>Tax Percentage %</label>
                        @error('tax')
                        <p class="text-danger" role="alert">
                            <i class="far fa-times-circle"></i>
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                        <input type="number" step="any" name="tax"
                               class="form-control @error('tax') is-invalid @enderror" placeholder="Tax Percentage ..."
                               value="{{$data->percentage}}">
                    </div>

                    <button type="submit" class="btn btn-success col-md-12">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
