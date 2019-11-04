@extends('app.layout')


@section('content')


<div class="container">
    <div class="users mx-auto col-12">
        <div class="titles">
            <h1>{{ $user->name }}</h1>
            <h1>{{ $user->email }}</h1>
        </div>
        <form action="{{ route('user.update', $user->id) }}" method="post">
            @csrf 
            @method('PUT')
            <ul class="boards">
                @foreach($boards as $board)
                <li class="col-4 col-md-6 col-sm-12">
                    {{ $board->name }}
                    @if($board->nsfw)
                    <span class="nsfw">(NSFW)</span>
                    @endif
                    <input 
                        type="checkbox" 
                        name="boards[]" 
                        value="{{ $board->id }}"  
                        @if(in_array($board->id, $user_boards))
                            checked
                        @endif
                        />
                </li>
                @endforeach
                
            </ul>

            <!-- Submit -->
            <div class="btn-wrapper">
                <button type="submit" >Save</button>
            </div>
        </form>
    </div>
</div>


@endsection