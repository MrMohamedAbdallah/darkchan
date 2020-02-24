<!-- Boards -->
{{-- <section class="mt-100" id="boards"> --}}
<section class="pt-60 boards-page" id="boards">


    <div class="title">
        <h1>{{ $slot }}</h1>
    </div>
    <ul class="boards col-8 col-md-10 col-sm-12">
        @foreach($boards as $board)
        <li class="col-3 col-md-4 col-sm-6">
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
            <h3>Disclamer</h3>
        </div>
        <div class="modal-text">
            To access this section of Darkchan (the "website"), you understand and agree to the following:
            <ol>
                <li>
                    The content of this website is for mature audiences only and may not be suitable for minors. If you
                    are a minor or it is illegal for you to access mature images and language, do not proceed.
                </li>
                <li>
                    This website is presented to you AS IS, with no warranty, express or implied. By clicking "I Agree,"
                    you agree not to hold 4chan responsible for any damages from your use of the website, and you
                    understand that the content posted is not owned or generated by 4chan, but rather by 4chan's users.
                </li>
            </ol>


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