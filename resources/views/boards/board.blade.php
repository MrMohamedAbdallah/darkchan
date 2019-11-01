@extends("app.layout")

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
            <input type="text" name="title" id="title" />
            <span class="invalid-feedback">Is not a valid email</span>
        </div>
        {{-- /Group  --}}
        {{-- Group --}}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" placeholder="Anonymous" />
            <span class="invalid-feedback">Is not a valid email</span>
        </div>
        {{-- /Group  --}}
        {{-- Group --}}
        <div class="form-group">
            <label for="password">password</label>
            <input type="text" name="password" id="password" value="V3rYsTr0nGP@ss#0rd" />
            <span class="invalid-feedback">Is not a valid email</span>
        </div>
        {{-- /Group  --}}
        {{-- Group --}}
        <div class="form-group">
            <label for="content">Body</label>
            <textarea type="text" name="content" id="content" rows="5"></textarea>
            <span class="invalid-feedback">Is not a valid email</span>
        </div>
        {{-- /Group  --}}
        {{-- Group --}}
        <div class="form-group">
            <label for="spoiler">Spoiler</label>
            <input type="checkbox" name="spoiler" id="spoiler">
            <span class="invalid-feedback">Is not a valid email</span>
        </div>
        {{-- /Group  --}}
        {{-- Group --}}
        <div class="form-group">
            <label for="file">Picture</label>
            <input type="file" name="file" id="file">
            <span class="invalid-feedback">Is not a valid email</span>
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


<!-- Thread -->
@foreach($threads as $thread)
<div class="col-10 mx-auto">
    <div class="thread">

        <!-- Menu -->
        <div class="menu">
            <i class="fas fa-ellipsis-v menu-icon"></i>
            <ul class="menu-list">
                <li hide-parent>Hide post</li>
                <li>Report post</li>
                <li>Delete post</li>
            </ul>
        </div>
        <!-- /Menu -->


        <!-- Header -->
        <div class="thread-header">
            <div class="thread-title">
                <a href="{{ route("thread", $thread->id) }}">
                    {{ $thread->title }}
                </a>
            </div>
            <div>
                <span class="thread-name">{{ $thread->name }}</span>
                <span class="thread-date">{{ $thread->created_at->diffForHumans() }}</span>
            </div>
        </div>
        <!-- /Header -->

        <!-- Paragraph -->
        @if($thread->content)
        <p class="thread-text">{{ $thread->content }}</p>
        @endif
        <!-- /Paragraph -->

        <!-- Files  -->
        @if($thread->file1)
        <div class="files">
            @if($thread->spoiler)
            <div class="file spoiler">
                <img src="" data-big="/storage/{{ $thread->file1 }}" />
            </div>
            @else
            <div class="file">
                <img src="/storage/{{ $thread->file2 }}" data-big="/storage/{{ $thread->file1 }}" />
            </div>
            @endif
        </div>
        @endif
        <!-- /Files -->

        <!-- ============================= -->
        <!--            Comments           -->
        <!-- ============================= -->
        @if($thread->comments->count())
        {{-- {{ dd(is_array(array($thread->comments->take(5)))) }} --}}
        <div class="comments" style="display: flex; flex-direction: column-reverse;">
            @foreach($thread->comments->take(5) as $comment)
            {{-- Comment Component --}}
            @component('components.comment', compact('comment'))
            @endcomponent
            {{-- /Comment Component --}}
            @endforeach

        </div>
        @endif
        <!-- /Comments -->

        <!-- Add comment section -->
        <div class="btn-wrapper">
            <a href="{{ route("thread", $thread->id) }}" class="btn-block" style="text-align:center">Add Comment</a>
        </div>
    </div>
</div>
@endforeach
<!-- /Thread -->


<!-- ========================== -->
<!--         Pagination         -->
<!-- ========================== -->
<ul class="pagination">
    <li><a href="#">
            <</a> </li> <li class="active"><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">...</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li><a href="#">></a></li>
</ul>

<!-- /Pagination -->


<!-- ============================= -->
<!--               modal           -->
<!-- ============================= -->
<div class="modal hide">
    <div class="modal-body">
        <!-- Form container -->
        <div class="form-container">
            <form action="" method="POST" class="border col-5">
                <!-- Group -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="invalid" />
                    <span class="invalid-feedback">Is not a valid email</span>
                </div>
                <!-- /Group -->
                <!-- Group -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" />
                    <span class="invalid-feedback">Is not a valid email</span>
                </div>
                <!-- /Group -->

                <!-- Submit -->
                <div class="form-group btn-wrapper">
                    <button type="submit">Login</button>
                </div>
            </form>
        </div>
        <!-- /Form container -->
    </div>
</div>
<!-- /Model -->


@endsection