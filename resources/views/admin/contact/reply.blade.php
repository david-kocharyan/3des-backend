@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        <!-- general form elements disabled -->
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title text-uppercase">{{$title}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Message</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fas fa-user mr-1"></i>Full name</strong>
                        <p class="text-muted">
                            {{$data->first_name." ".$data->last_name}}
                        </p>
                        <hr>

                        <strong><i class="fas fa-phone-alt mr-1"></i>Phone</strong>
                        <p class="text-muted">{{$data->phone}}</p>
                        <hr>

                        <strong><i class="fas fa-mail-bulk mr-1"></i>Email</strong>
                        <p class="text-muted">{{$data->email}}</p>
                        <hr>

                        <strong><i class="far fa-file-alt mr-1"></i> Message</strong>
                        <p class="text-muted">{{$data->message}}</p>
                    </div>
                    <!-- /.card-body -->
                </div>

                <form method="post" action="{{$route."/".$data->id }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method("PUT")

                    <div class="form-group">
                        <label>Subject</label>
                        @error('subject')
                        <p class="text-danger" role="alert">
                            <i class="far fa-times-circle"></i>
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                        <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror"
                               value="{{old('subject')}}" placeholder="Subject ...">
                    </div>

                    <div class="form-group">
                        <label>Answer</label>
                        @error('answer')
                        <p class="text-danger" role="alert">
                            <i class="far fa-times-circle"></i>
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                        <textarea class="form-control @error('answer') is-invalid @enderror" name="answer" rows="10"
                                  placeholder="Answer ..."
                                  style="resize: none">{{old('answer')}}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success col-md-12">Reply</button>
                </form>
            </div>
        </div>
    </div>
@endsection

