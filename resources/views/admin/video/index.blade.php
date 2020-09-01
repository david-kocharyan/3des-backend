@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add Or Edit Video</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{$route}}@if(isset($data)){{"/".$data->id }}@endif"
                          enctype="multipart/form-data">
                        @csrf
                        @if(isset($data))
                            @method("PUT")
                        @endif

                        <div class="form-group">
                            <label>Add Video <span class="text-danger">(video type must be` mp4, mov, ogg, qt and max-size is 20MB)</span></label>
                            @error('link')
                            <p class="text-danger" role="alert">
                                <i class="far fa-times-circle"></i>
                                <strong>{{ $message }}</strong>
                            </p>
                            @enderror
                            <div class="custom-file">
                                <input type="file" name="link" id="customFile"
                                       class="custom-file-input @error('link') is-invalid @enderror">
                                <label class="custom-file-label" for="customFile">Choose video</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary col-md-12">Save</button>
                    </form>
                </div>
            </div>

            @if(isset($data->link) and $data->link != null)
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Video</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <video controls src="{{asset('uploads/'.$data->link)}}"></video>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection


@push('footer')
    <script src="{{asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script !src="">
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@endpush
