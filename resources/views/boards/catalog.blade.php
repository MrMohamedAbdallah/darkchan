@extends('app.layout')


@section("content")

{{-- Board Header --}}
@component('components.board_header', compact('board'))
@slot('form')
<!-- Form container -->
<div class="form-container" id="create-thread" style="min-height: auto;">

    <form action="{{ route("thread.create") }}" method="POST" enctype="multipart/form-data" class="border col-5">
        <i class="fas fa-times" id="hide-create-thread" style="display: block; text-align: right; cursor: pointer;"></i>
        @csrf
        <input type="hidden" name="board" value="{{ $board->id }}">
        {{-- Group --}}
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}"
                class="@error('title') invalid @enderror" />
            @error('title')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        {{-- /Group  --}}
        {{-- Group --}}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" placeholder="Anonymous" value="{{ old('name') }}"
                class="@error('name') invalid @enderror" />
            @error('name')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        {{-- /Group  --}}
        {{-- Group --}}
        <div class="form-group">
            <label for="password">password</label>
            <input type="text" name="password" id="password"
                value="{{  old('password') ? old('password') : 'V3rYsTr0nGP@ss#0rd' }}"
                class="@error('password') invalid @enderror" />
            @error('password')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        {{-- /Group  --}}
        {{-- Group --}}
        <div class="form-group">
            <label for="content">Body</label>
            <textarea type="text" name="content" id="content" rows="5"
                class="@error('content') invalid @enderror">{{ old('content') }}</textarea>
            @error('content')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        {{-- /Group  --}}
        {{-- Group --}}
        <div class="form-group">
            <label for="spoiler">Spoiler</label>
            <input type="checkbox" name="spoiler" id="spoiler" {{ old('spoiler') ? 'checked' : ''  }}
                class="@error('spoiler') invalid @enderror">
            @error('spoiler')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        {{-- /Group  --}}
        {{-- Group --}}
        <div class="form-group">
            <label for="file">Picture</label>
            <input type="file" name="file" id="file" value="{{ old('password') }}"
                class="@error('file') invalid @enderror">
            @error('file')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        {{-- /Group  --}}


        <!-- Submit -->
        <div class="form-group btn-wrapper">
            <button type="submit">Create</button>
        </div>
    </form>
</div>

<!-- /Form container -->
@endslot
@slot('button')
<button id="show-create-thread">Start A New Thread</button>
@endslot
@endcomponent
{{-- /Board Header --}}

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

{{ $threads->links() }}


@else

<h1>No Threads In This Board Yet :(</h1>

@endif




@endsection