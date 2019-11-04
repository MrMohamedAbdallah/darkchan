@extends("app.layout")

@section("content")
<div style="padding-bottom: 75px"></div>

<!-- Banner -->
@if($board->cover)
<div class="col-10 mx-auto">
    <img src="/storage/{{ $board->cover }}" alt="board name" class="banner" />
</div>
@endif
<!-- /Banner -->

<!-- Form container -->
<div class="col-8 mx-auto">
    <form style="border-radius: 10px;" action="{{ route("board.update", $board->link) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        {{-- Form Group --}}
        <div class="form-group">
            <label for="name">Name: </label>
            <input type="text" name="name" id="name" value="{{ old('name') ? old('name') : $board->name }}"
                class="form-control @error('name')invalid @enderror">
            @error('name')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        {{-- /Form Group --}}
        {{-- Form Group --}}
        <div class="form-group">
            <label for="link">Link: </label>
            <input type="text" name="link" id="link" value="{{ old('link') ? old('link') : $board->link }}"
                class="form-control @error('link') invalid @enderror">
            @error('link')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        {{-- /Form Group --}}
        {{-- Form Group --}}
        <div class="form-group">
            <label for="msg">msg: </label>
            <input type="text" name="msg" id="msg" value="{{ old('msg') ? old('msg') : $board->msg }}"
                class="form-control @error('msg') invalid @enderror">
            @error('msg')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        {{-- /Form Group --}}
        {{-- Form Group --}}
        <div class="form-group">
            <label for="cover">Cover: </label>
            <input type="file" name="cover" id="cover" class="form-control @error('cover') invalid @enderror">
            @error('cover')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        {{-- /Form Group --}}
        {{-- Form Group --}}
        <div class="form-group">
            <label for="name">NSFW: </label>
            <input type="checkbox" name="nsfw" id="nsfw" {{ old('nsfw') ? 'checked': $board->nsfw ? 'checked' : '' }}
                class="@error('nsfw') invalid @enderror">
            @error('nsfw')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        {{-- /Form Group --}}
        {{-- Form Group --}}
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </div>
        {{-- /Form Group --}}
    </form>
    <!-- Submit -->
    <div class="btn-wrapper">
        <form action="{{ route("board.delete", $board->id) }}" method="POST" style="background-color: transparent; margin-top: 10px;">
            @csrf    
            @method("DELETE")
            <button type="submit" class="btn-danger">Delete</button>
        </form>
    </div>
</div>
<!-- /Form container -->


@endsection