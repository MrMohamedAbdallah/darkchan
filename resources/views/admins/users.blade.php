@extends('app.layout')


@section('content')


<div class="users mx-auto col-6 col-md-8 col-sm-12">
    <table>
        <thead>
            <tr>
                <td>Username</td>
                <td>Email</td>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td><a href="{{ route('user.edit', $user->id) }}" class="link-violet">{{ $user->name }}</a></td>
                <td>{{ $user->email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>





@endsection