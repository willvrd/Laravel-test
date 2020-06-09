{{-- @extends('user::layouts.master') --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User - Users - Index</div>

                <div class="card-body">

                    This view is loaded from module: {!! config('user.name') !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
