{{-- @extends('user::layouts.master') --}}

@extends('layouts.app')

@section('content')

    <user-index
        title="{{ __("user::users.title.users") }}"
        module-name="{!! config('user.name') !!}"
        init-msj="{{ __("user::common.messages.welcome") }}">
    </user-index>

@endsection

<!-- User Scripts -->
@section('scripts-modules')
    <script src="{{ mix('js/user.js') }}"></script>
@stop
