{{-- @extends('user::layouts.master') --}}

@extends('layouts.app')

@section('content')


    <role-index
        title="{{ __("user::roles.title.roles") }}"
        module-name="{!! config('user.name') !!}"
        init-msj="{{ __("user::common.messages.welcome") }}"
        path="{{route(app()->getLocale().'.api.user.roles.index')}}">
    </role-index>

@endsection

<!-- User Scripts -->
@section('scripts-modules')
    <script src="{{ mix('js/user.js') }}"></script>
@stop
