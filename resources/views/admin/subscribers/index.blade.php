@extends('layouts.admin')
@section('content')


    <div class="col-md-12">
        <!-- general form elements disabled -->
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title text-uppercase">{{$title}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="post" action="{{$route}}"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>Subject</label>
                        @error('subject')
                        <p class="text-danger" role="alert">
                            <i class="far fa-times-circle"></i>
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                        <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror"
                               placeholder="Subject ..." value="{{ old('subject')}}">
                    </div>

                    <div class="form-group">
                        <label>Message</label>
                        @error('message')
                        <p class="text-danger" role="alert">
                            <i class="far fa-times-circle"></i>
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                        <textarea class="form-control @error('message') is-invalid @enderror" name="message" rows="10"
                                  placeholder="Message ..."
                                  style="resize: none">{{old('message')}}</textarea>
                    </div>

                    <button type="submit" class="btn btn-warning col-md-12">Send</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('header')
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('admin/plugins/toastr/toastr.min.css')}}">
@endpush

@push('footer')
    <!-- Toastr -->
    <script src="{{asset('admin/plugins/toastr/toastr.min.js')}}"></script>
    <script !src="">
        $(document).ready(function () {
            var message = "{{Session::get('message')}}";
            if (message != "") {
                toastr.success(message)
            }
        });
    </script>
@endpush
