<div class="comment mb-3">

    <!-- Menu -->
    <div class="menu">
        <i class="fas fa-ellipsis-v menu-icon"></i>
        <ul class="menu-list">
            <li hide-parent>Hide comment</li>
            <li>Report comment</li>
            <li data-show="#comment-form{{ $comment->id }}">Delete comment</li>
        </ul>
    </div>
    <!-- /Menu -->


    <form id="comment-form{{ $comment->id }}" action="{{ route('comment.delete') }}" method="post" class="delete-form">
        @csrf
        @method("DELETE")
        <input type="hidden" name="comment" value="{{ $comment->id }}">
        <input type="hidden" name="board" value="{{ $board->id }}">
        <div class="form-group">
            <label>passwrod</label>
            <input type="password" name="password">
        </div>
        <div class="form-group">
            <button type="submit">Delete</button>
        </div>
    </form>

    <!-- Header -->
    <div class="thread-header">
        <div>
            <span class="thread-name">{{ $comment->name }}</span>
            <span class="thread-date">{{ $comment->created_at->diffForHumans() }}</span>
        </div>
    </div>
    <!-- /Header -->

    <!-- Paragraph -->
    @if($comment->content)
    <p class="thread-text">{{ $comment->content }}</p>
    @endif
    <!-- /Paragraph -->

    <!-- Files  -->
    @if($comment->file1)
    <div class="files">
        @if($comment->spoiler)
        <div class="file spoiler">
            <img src="" data-big="/storage/{{ $comment->file1 }}" />
        </div>
        @else
        <div class="file">
            <img src="/storage/{{ $comment->file2 }}" data-big="/storage/{{ $comment->file1 }}" />
        </div>
        @endif
    </div>
    @endif
    <!-- /Files -->
</div>