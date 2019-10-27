@extends("app.layout")

@section("content")

{{-- Header --}}
<h1 class="my-5 text-center diaply-4 font-weight-bolder">Create A Board</h1>

<div class="container">

    @if(Session::has("success"))
    <div class="my-3 alert alert-success">
        {{ Session::get("success") }}
    </div>
    @endif

    @if($errors->any())
        <div class="my-3 alert alert-danger">
            <ul>
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
        @endif

    <div class="row">
        <div class="col-md-6 mx-auto bg-dark text-primary rounded p-3">
            <form action="{{ route("board.store") }}" method="POST" enctyp="multipart/form-data">
                @csrf
                {{-- Form Group --}}
                <div class="form-group">
                    <label for="name">Name: </label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                {{-- /Form Group --}}
                {{-- Form Group --}}
                <div class="form-group">
                    <label for="name">Link: </label>
                    <input type="text" name="link" id="link" class="form-control">
                </div>
                {{-- /Form Group --}}
                {{-- Form Group --}}
                <div class="form-group">
                    <label for="name">msg: </label>
                    <input type="text" name="msg" id="msg" class="form-control">
                </div>
                {{-- /Form Group --}}
                {{-- Form Group --}}
                <div class="form-group">
                    <label for="name">Cover: </label>
                    <input type="file" name="cover" id="cover" class="form-control">
                </div>
                {{-- /Form Group --}}
                {{-- Form Group --}}
                <div class="form-group">
                    <label for="name">NSFW: </label>
                    <input type="checkbox" name="nsfw" id="nsfw" checked>
                </div>
                {{-- /Form Group --}}
                {{-- Form Group --}}
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </div>
                {{-- /Form Group --}}


            </form>
        </div>
    </div>
</div>


@endsection