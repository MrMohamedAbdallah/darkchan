<!-- Boards -->
{{-- <section class="mt-100" id="boards"> --}}
<section class="pt-60 boards-page" id="boards">
    <div class="title">
        <h1>{{ $slot }}</h1>
    </div>
    <ul class="boards col-8">
        @foreach($boards as $board)
        <li>
            @if($board->nsfw)
            <a href="{{ route('board', $board->link) }}" class="nsfw-link">
                {{ $board->name }} <span class="nsfw">(NSFW)</span>
            </a>
            @else
            <a href="{{ route('board', $board->link) }}">
                {{ $board->name }}
            </a>
            @endif
        </li>
        @endforeach
    </ul>
</section>
<!-- /Boards -->


<!-- ============================== -->
<!--              NSFW Modal          -->
<!-- ============================== -->
<div class="nsfw-modal">
    <div class="modal-body">
        <div class="modal-header">
            <h3>Diclamer</h3>
        </div>
        <div class="modal-text">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus in
            corporis ea mollitia sequi consequuntur laborum ducimus et non iure
            earum, eveniet, reiciendis error eos ipsam, quidem est architecto
            tempora!Rem optio cumque ipsa odio numquam consectetur, in temporibus
            omnis consequuntur ut nostrum voluptate ducimus, dicta eligendi
            consequatur, dolore fugiat velit inventore incidunt eveniet
            perferendis laboriosam quia modi. Consequatur, ad!
        </div>
        <div class="modal-footer">
            <a href="" id="modal-link">Accept</a>
            <button class="modal-cancel">Cancel</button>
        </div>
    </div>
    <div class="modal-overlay modal-cancel"></div>
</div>

<!--              NSFW Modal          -->
<!-- ================================ -->