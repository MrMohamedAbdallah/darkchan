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

    @foreach ($threads as $thread)
    <div class="mx-auto my-3">
        <div class="card">
            <div class="card-header">
                {{ $thread->title }} <span class="text-danger">{{ $thread->name }}</span> <small>{{ $thread->created_at }}</small>
            </div>
            <div class="card-body">
                <div class="card-text">
                    {{ $thread->content }}
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>






@endsection