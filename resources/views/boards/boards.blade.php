@extends("app.layout")

@section("content")
<div class="container my-5">
    <div class="row">
        @foreach($boards as $board)
        <div class="col-md-4">
            <div class="d-flex">
                <div class="mx-1">
                    /
                    <a href="/board/{{ $board->link }}">
                        {{ substr($board->link ,0,2) }}
                    </a>
                    /
                </div>
                <div class="mx-1">{{ explode(' ',$board->name)[0] }}</div>
                @if($board->nsfw)
                <div class="mx-1 capitalize font-weight-bolder text-danger">NSFW</div>
                @endif
            </div>
        </div>
        
        @endforeach
    </div>
</div>
@endsection