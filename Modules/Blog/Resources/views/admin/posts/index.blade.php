{{-- @extends('user::layouts.master') --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Blog - Posts - Index</div>

                <div class="card-body">

                    {{ __("blog::common.messages.welcome") }}: {!! config('blog.name') !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
