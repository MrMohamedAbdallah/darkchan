@extends("app.layout")

@section("content")

<div class="container my-4">
    <div class="alert alert-primary">
        /
        <a href="{{ route("board", $board->link) }}">
            {{ $board->link }}
        </a>
        / - {{ $board->name }}
    </div>


    {{-- Board Cover --}}
    @if($board->cover)
    <img src="/storage/{{ $board->cover }}" alt="{{ $board->name }}" class="img-fluid">
    @endif



    @if($board->msg)
    <div class="border p-4 mb-4">
        {{ $board->msg }}
    </div>
    @endif


    <div class="my-4">
        <fieldset>
            <legend>Create Thread</legand>
                <form action="{{ route("comment.create") }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="thread" value="{{ $thread->id }}">
                    {{-- Form Group --}}
                    <div class="form-group">
                        <label for="name">name: </label>
                        <input type="text" name="name" id="name" placeholder="Anonymous" class="form-control">
                    </div>
                    {{-- /Form Group --}}
                    {{-- Form Group --}}
                    <div class="form-group">
                        <label for="password">Password: </label>
                        <input type="texst" name="password" id="password" class="form-control"
                            value="V3rYsTr0nGP@ss#0rd">
                    </div>
                    {{-- /Form Group --}}
                    {{-- Form Group --}}
                    <div class="form-group">
                        <label for="content">Body: </label>
                        <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    {{-- /Form Group --}}
                    {{-- Form Group --}}
                    <div class="form-group">
                        <label for="spoiler">Spoiler: </label>
                        <input type="checkbox" name="spoiler" id="spoiler">
                    </div>
                    {{-- /Form Group --}}
                    {{-- Form Group --}}
                    <div class="form-group">
                        <label for="file">File: </label>
                        <input type="file" name="file" id="file">
                    </div>
                    {{-- /Form Group --}}
                    {{-- Form Group --}}
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    {{-- /Form Group --}}

                </form>
        </fieldset>
    </div>





    <div class="mx-auto my-3">
        <div class="card">
            <div class="card-header">
                <a href="{{ route("thread", $thread->id) }}">{{ $thread->title }}</a> <span
                    class="text-danger">{{ $thread->name }}</span>
                <small>{{ $thread->created_at->diffForHumans() }}</small>
                @if($thread->spoiler)
                <span class="text-danger font-weight-bolder">SPOILER</span>
                @endif
            </div>
            <div class="card-body">
                <div class="card-text">
                    {{ $thread->content }}
                </div>

                {{-- Comments --}}
                <div class="bg-dark p-3 rounded border text-primary">
                    @foreach($thread->comments as $comment)
                    <div class="card-header bg-dark text-white">
                        <span class="text-danger">{{ $comment->name }}</span>
                        <small>{{ $comment->created_at->diffForHumans() }}</small>
                        @if($comment->spoiler)
                        <span class="text-primary font-weight-bolder">SPOILER</span>
                        @endif
                    </div>
                    <div class="card-body text-white">

                        {{-- Delete --}}
                        <form action="{{ route("comment.delete") }}" method="post">
                            @csrf
                            @method("DELETE")
                            <input type="hidden" name="comment" value="{{ $comment->id }}">
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Passowrd">
                            <button class="btn btn-danger my-3">Delete</button>
                        </form>
                        {{-- Delete --}}

                        @if($comment->file)
                        <img src="/storage/{{ $comment->file }}" alt="" class="img-fluid">
                        @endif
                        {{ $comment->content }}
                    </div>
                    @endforeach
                </div>
                {{-- /Comments --}}

            </div>
        </div>
    </div>


</div>






@endsection