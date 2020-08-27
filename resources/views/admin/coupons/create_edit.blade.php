@extends('layouts.admin')
@section('content')


    <div class="col-md-12">
        <!-- general form elements disabled -->
        <div class="card card-danger">
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
                               placeholder="Name ..." value="{{ $data->name ?? old('name')}}">
                    </div>

                    <div class="form-group">
                        <label>Code <span class="text-danger">(Min. characters` 6)</span></label>
                        @error('code')
                        <p class="text-danger" role="alert">
                            <i class="far fa-times-circle"></i>
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="code input-group-text" style="cursor: pointer"><i class="fas fa-redo-alt"></i></span>
                            </div>
                            <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror"
                                   placeholder="Code ..." value="{{ $data->code ?? old('code')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Percentage</label>
                        @error('percentage')
                        <p class="text-danger" role="alert">
                            <i class="far fa-times-circle"></i>
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                        <input type="number" name="percentage"
                               class="form-control @error('percentage') is-invalid @enderror"
                               placeholder="Percentage (%) ..." value="{{ $data->percentage ?? old('percentage')}}">
                    </div>

                    <div class="form-group">
                        <label>Start Date</label>
                        @error('start')
                        <p class="text-danger" role="alert">
                            <i class="far fa-times-circle"></i>
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                        <input type="date" name="start" class="form-control @error('start') is-invalid @enderror"
                               placeholder="Start Date ..." value="{{ $data->start ?? old('start')}}">
                    </div>

                    <div class="form-group">
                        <label>Finish Date</label>
                        @error('finish')
                        <p class="text-danger" role="alert">
                            <i class="far fa-times-circle"></i>
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                        <input type="date" name="finish" class="form-control @error('finish') is-invalid @enderror"
                               placeholder="Finish Date ..." value="{{ $data->finish ?? old('finish')}}">
                    </div>

                    <button type="submit" class="btn btn-danger col-md-12">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('footer')
    <script>
        $(document).ready(function () {
            $('.code').click(function () {
                var code = generateCode();
                $('#code').val(code);
            });

            function generateCode() {
                var length = 6,
                    charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
                    retVal = "";
                for (var i = 0, n = charset.length; i < length; ++i) {
                    retVal += charset.charAt(Math.floor(Math.random() * n));
                }
                return retVal;
            }
        })
    </script>
@endpush
