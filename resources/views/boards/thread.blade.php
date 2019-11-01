@extends("app.layout")

@section("content")


{{-- Board Header --}}
@component('components.board_header', compact('board'))
@slot('form')
@endslot
@slot('button')
<button class="show-comment-modal">Add comment</button>
@endslot
@endcomponent
{{-- /Board Header --}}

<div class="col-10 mx-auto">
    <div class="thread">

        <!-- Menu -->
        <div class="menu">
            <i class="fas fa-ellipsis-v menu-icon"></i>
            <ul class="menu-list">
                <li>Report post</li>
                <li>Delete post</li>
            </ul>
        </div>
        <!-- /Menu -->


        <!-- Header -->
        <div class="thread-header">
            <div class="thread-title">
                {{ $thread->title }}
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
        <div class="comments">
            @foreach($thread->comments as $comment)
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
            <button class="btn-block show-comment-modal">Add Comment</button>
        </div>
    </div>
</div>



<!-- ============================= -->
<!--               modal           -->
<!-- ============================= -->
<div class="modal" id="comment-modal">
    <i class="fas fa-times close"></i>

    <!-- Form container -->
    <div class="form-container">
        <form action="{{ route("comment.create") }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="thread" value="{{ $thread->id }}">
            <!-- Group -->
            <div class="form-group">
                <label for="name">name: </label>
                <input type="text" name="name" id="name" placeholder="Anonymous" class="form-control">
                <span class="invalid-feedback">Is not a valid email</span>
            </div>
            <!-- /Group -->
            {{-- Group --}}
            <div class="form-group">
                <label for="password">Password: </label>
                <input type="texst" name="password" id="password" class="form-control" value="V3rYsTr0nGP@ss#0rd">
            </div>
            {{-- /Group --}}
            {{-- Group --}}
            <div class="form-group">
                <label for="content">Body: </label>
                <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
            </div>
            {{-- /Group --}}
            {{-- Group --}}
            <div class="form-group">
                <label for="spoiler">Spoiler: </label>
                <input type="checkbox" name="spoiler" id="spoiler">
            </div>
            {{-- /Group --}}
            {{-- Group --}}
            <div class="form-group">
                <label for="file">File: </label>
                <input type="file" name="file" id="file">
            </div>
            {{-- /Group --}}


            <!-- Submit -->
            <div class="form-group btn-wrapper">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
    <!-- /Form container -->
</div>



@endsection