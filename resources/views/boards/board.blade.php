@extends("app.layout")

@section("content")

<div class="container my-4">
    <div class="alert alert-primary">
        /{{ $board->link }}/ - {{ $board->name }}
    </div>

    @if($board->msg)
    <div class="border p-4 mb-4">
        {{ $board->msg }}
    </div>
    @endif


    <div class="my-4">
        <fieldset>
            <legend>Create Thread</legand>
            <form action="{{ route("comment.create") }}" method="post">
                @csrf
                <input type="hidden" name="board" value="{{ $board->id }}">
                {{-- Form Group --}}
                <div class="form-group">
                    <label for="title">Title: </label>
                    <input type="text" name="title" id="title" class="form-control">
                </div>
                {{-- /Form Group --}}
                {{-- Form Group --}}
                <div class="form-group">
                    <label for="name">name: </label>
                    <input type="text" name="name" id="name" placeholder="Anonymous" class="form-control">
                </div>
                {{-- /Form Group --}}
                {{-- Form Group --}}
                <div class="form-group">
                    <label for="password">Password: </label>
                    <input type="texst" name="password" id="password" class="form-control" value="V3rYsTr0nGP@ss#0rd">
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
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                {{-- /Form Group --}}
                
            </form>
        </fieldset>
    </div>




    @foreach ($threads as $thread)
    <div class="mx-auto my-3">
        <div class="card">
            <div class="card-header">
                <a href="{{ route("thread", $thread->id) }}">{{ $thread->title }}</a> <span class="text-danger">{{ $thread->name }}</span> <small>{{ $thread->created_at }}</small>
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
                    @foreach($thread->comments->take(5) as $comment)
                    <div class="card-header bg-dark text-white">
                        <span class="text-danger">{{ $comment->name }}</span> <small>{{ $comment->created_at }}</small>
                    </div>
                    <div class="card-body text-white">
                        {{ $comment->content }}
                    </div>
                    @endforeach
                </div>
                {{-- /Comments --}}
                
            </div>
        </div>
    </div>
    @endforeach

</div>






@endsection