@extends("app.layout")

@section("content")
@component('components.boards', compact("boards"))
    {{ $title }}
@endcomponent
@endsection