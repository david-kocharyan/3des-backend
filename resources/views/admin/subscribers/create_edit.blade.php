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
                        <label> Question</label>
                        @error('question')
                        <p class="text-danger" role="alert">
                            <i class="far fa-times-circle"></i>
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                        <input type="text" name="question" class="form-control @error('question') is-invalid @enderror" placeholder="Question ..." value="{{ $data->question ?? old('question')}}">
                    </div>

                    <div class="form-group">
                        <label>Answer</label>
                        @error('answer')
                        <p class="text-danger" role="alert">
                            <i class="far fa-times-circle"></i>
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                        <textarea class="form-control @error('answer') is-invalid @enderror" name="answer" rows="10" placeholder="Answer ..."
                                  style="resize: none">{{ $data->answer ?? old('answer')}}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success col-md-12">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
