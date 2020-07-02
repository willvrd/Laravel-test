{{-- @extends('user::layouts.master') --}}

@extends('layouts.app')

@section('content')

    <category-index
        title="{{ __("blog::categories.title.categories") }}"
        module-name="{!! config('blog.name') !!}"
        init-msj="{{ __("blog::common.messages.welcome") }}">
    </category-index>

@endsection
