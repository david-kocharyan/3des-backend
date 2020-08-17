@extends('layouts.admin')

@section('content')
    <div class="card">

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            {{ 'You are logged in ' . Auth::user()->name ." !" }}
        </div>
    </div>
@endsection
