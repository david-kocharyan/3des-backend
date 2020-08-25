@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{$title}}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Type</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $key=>$val)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$val->first_name}}</td>
                                <td>{{$val->last_name}}</td>
                                <td>{{$val->email}}</td>
                                <td>{{$val->phone}}</td>
                                <td>
                                    <span class="badge @if($val->type == 0) badge-danger @else badge-success @endif">{{\App\Models\Contact::TYPE[$val->type]}}</span>
                                </td>
                                <td>
                                    <a href="{{$route."/".$val->id."/edit"}}" title="Edit"
                                       class="btn btn-success btn-circle">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form style="display: inline-block" action="{{ $route."/".$val->id }}"
                                          method="post">
                                        @csrf
                                        @method("DELETE")
                                        <a href="javascript:void(0);" data-text="{{ $title }}" class="delete_form"
                                           data-id="{{$val->id}}">
                                            <button title="Remove" class="btn btn-danger btn-circle"><i
                                                    class="fas fa-trash"></i>
                                            </button>
                                        </a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{$data->links('vendor.pagination.bootstrap-4')}}
                </div>
            </div>
            <!-- /.card -->
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
