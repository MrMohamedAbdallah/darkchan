{{-- Head --}}
@include("app.head")

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
</div>

{{-- Page contetn --}}
@yield("content")


{{-- Footer --}}
@include("app.footer")