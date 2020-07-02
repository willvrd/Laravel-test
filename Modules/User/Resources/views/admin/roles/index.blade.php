{{-- @extends('user::layouts.master') --}}

@extends('layouts.app')

@section('content')

    <h1>Rolesss</h1>

@endsection

<!-- User Scripts -->
@section('scripts-modules')
    <script src="{{ mix('js/user.js') }}"></script>
@stop
