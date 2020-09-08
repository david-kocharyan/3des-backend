@extends('layouts.admin')
@section('content')


    <div class="col-md-12">
        <!-- general form elements disabled -->
        <div class="card card-purple">
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
                        <label>Email</label>
                        @error('email')
                        <p class="text-danger" role="alert">
                            <i class="far fa-times-circle"></i>
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               placeholder="Email ..." value="{{ $data->email ?? old('email')}}">
                    </div>

                    <div class="form-group">
                        <label>Password <span class="text-danger">(Min. characters` 8)</span></label>
                        @error('password')
                        <p class="text-danger" role="alert">
                            <i class="far fa-times-circle"></i>
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="password input-group-text" style="cursor: pointer"><i class="fas fa-redo-alt"></i></span>
                            </div>
                            <input type="text" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Password ..." value="{{ $data->password ?? old('password')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        @error('phone')
                        <p class="text-danger" role="alert">
                            <i class="far fa-times-circle"></i>
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                               placeholder="Phone ..." value="{{ $data->phone ?? old('phone')}}">
                    </div>

                    {{---------Partner part---------}}
                    <div class="form-group">
                        <label>Company</label>
                        @error('company')
                        <p class="text-danger" role="alert">
                            <i class="far fa-times-circle"></i>
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                        <input type="text" name="company" class="form-control @error('company') is-invalid @enderror"
                               placeholder="Company ..." value="{{ $data->parent->company ?? old('company')}}">
                    </div>

                    <div class="form-group">
                        <label>Country</label>
                        @error('country')
                        <p class="text-danger" role="alert">
                            <i class="far fa-times-circle"></i>
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                        <input type="text" name="country" class="form-control @error('country') is-invalid @enderror"
                               placeholder="Country ..." value="{{ $data->parent->country ?? old('country')}}">
                    </div>

                    <div class="form-group">
                        <label>State</label>
                        @error('state')
                        <p class="text-danger" role="alert">
                            <i class="far fa-times-circle"></i>
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                        <input type="text" name="state" class="form-control @error('state') is-invalid @enderror"
                               placeholder="State ..." value="{{ $data->parent->state ?? old('state')}}">
                    </div>

                    <div class="form-group">
                        <label>City</label>
                        @error('city')
                        <p class="text-danger" role="alert">
                            <i class="far fa-times-circle"></i>
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                        <input type="text" name="city" class="form-control @error('city') is-invalid @enderror"
                               placeholder="City ..." value="{{ $data->parent->city ?? old('city')}}">
                    </div>

                    <div class="form-group">
                        <label>Street</label>
                        @error('street')
                        <p class="text-danger" role="alert">
                            <i class="far fa-times-circle"></i>
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                        <input type="text" name="street" class="form-control @error('street') is-invalid @enderror"
                               placeholder="Street ..." value="{{ $data->parent->street ?? old('street')}}">
                    </div>

                    <div class="form-group">
                        <label>Zip</label>
                        @error('zip')
                        <p class="text-danger" role="alert">
                            <i class="far fa-times-circle"></i>
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                        <input type="text" name="zip" class="form-control @error('zip') is-invalid @enderror"
                               placeholder="Zip ..." value="{{ $data->parent->state ?? old('zip')}}">
                    </div>

                    <button type="submit" class="btn col-md-12" style="background-color: #6f42c1; color: white;">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('footer')
    <script>
        $(document).ready(function () {
            $('.password').click(function () {
                var code = generateCode();
                $('#password').val(code);
            });

            function generateCode() {
                var length = 8,
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
