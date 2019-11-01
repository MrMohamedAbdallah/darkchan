<div style="padding-bottom: 75px"></div>
<!-- Banner -->
@if($board->cover)
<div class="col-10 mx-auto">
    <img src="/storage/{{ $board->cover }}" alt="board name" class="banner"/>
</div>
@endif
<!-- /Banner -->

{{ $form }}
<!-- Titiles -->
<div class="titles">
    <h1>/ <a href="{{ route("board", $board->link) }}"><mark>{{ $board->link }}</mark></a> / - <mark>{{ $board->name }}</mark></h1>
    <h1>
        <mark>
            <a href="#">Catalog</a>
        </mark>
        -
        <mark>
            {!! $button !!}
        </mark>
    </h1>
</div>
<!-- /Titiles -->

<!-- Msg -->
@if($board->msg)
<div class="board-msg">
    <p>{{ $board->msg }}</p>
</div>
@endif
<!-- /Msg -->