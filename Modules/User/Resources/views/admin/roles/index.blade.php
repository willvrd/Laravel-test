{{-- @extends('user::layouts.master') --}}

@extends('layouts.app')

@section('content')

    <role-index
        :title="{singular:'{{trans_choice('user::roles.title.role', 1)}}',plural:'{{trans_choice('user::roles.title.role', 2)}}'}"
        path="{{route(app()->getLocale().'.api.user.roles.index')}}">
    </role-index>

@endsection

<!-- User Scripts -->
@section('scripts-modules')
    <script src="{{ mix('js/user.js') }}"></script>
@stop
