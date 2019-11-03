@extends('app.layout')


@section("content")

{{-- Board header component --}}
@component('components.board_header', compact('board'))
@slot('form')
@endslot
@slot('button')
@endslot
@endcomponent
{{-- /Board header component --}}

@if($threads->count())
<div class="container">
    <div class="row">
        @foreach($threads as $thread)

        <!-- Thread -->
        <div class="col-4 col-md-6 col-sm-12">
            <div class="thread-card">
                {{-- Thread file --}}
                @if($thread->file1)
                {{-- Spoiler --}}
                @if($thread->spoiler)
                <div class="card-img spoiler" data-spoiler>
                    <img src="/storage/{{ $thread->file2 }}" />
                </div>
                @else
                <div class="card-img">
                    <img src="/storage/{{ $thread->file2 }}" />
                </div>
                @endif
                @endif
                <div class="thread-info">
                    <span class="title">
                        <a href="{{ route("thread", $thread->id) }}">
                            {{ substr($thread->title, 0, 100) }}
                        </a>
                    </span>
                    <span class="name">{{ $thread->name }}</span>
                    <span class="date">{{ $thread->created_at->diffForHumans() }}</span>
                </div>
                <div class="thread-text">
                    <p>{{ substr($thread->content,0, 200) }}</p>
                </div>
            </div>
        </div>
        <!-- /Thread -->

        @endforeach
    </div>
</div>

@else

<h1>No Threads In This Board Yet :(</h1>

@endif




@endsection