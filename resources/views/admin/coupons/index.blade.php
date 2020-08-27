@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{$title}}</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <a class="btn btn-outline-secondary" href="{{$route."/create"}}">Create</a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Start</th>
                            <th>Finish</th>
                            <th>Type</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $key=>$val)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$val->name}}</td>
                                <td>{{$val->code}}</td>
                                <td>{{$val->start}}</td>
                                <td>{{$val->finish}}</td>
                                <td>
                                    <span
                                        class="badge @if($val->type == 0) badge-danger @else badge-success @endif">{{\App\Models\Coupon::TYPE[$val->type]}}</span>
                                </td>
                                <td>
                                    <a href="{{$route."/".$val->id."/edit"}}" title="Edit"
                                       class="btn btn-success btn-circle">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form style="display: inline-block" action="{{$route."/".$val->id."/disable"}}"
                                          method="post">
                                        @csrf
                                        @method("POST")
                                        <a href="javascript:void(0);" title="In Active">
                                            <button title="Remove" class="btn btn-warning btn-circle">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </a>
                                    </form>

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

