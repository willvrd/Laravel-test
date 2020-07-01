{{-- @extends('user::layouts.master') --}}

@extends('layouts.app')

@section('content')
<div class="container mb-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User - Users - Index</div>

                <div class="card-body">

                    {{ __("user::common.messages.welcome") }}: {!! config('user.name') !!}

                </div>
            </div>
        </div>
    </div>
</div>

<user-index></user-index>

@endsection

<!-- User Scripts -->
@section('scripts-modules')
    <script src="{{ mix('js/user.js') }}"></script>
@stop
