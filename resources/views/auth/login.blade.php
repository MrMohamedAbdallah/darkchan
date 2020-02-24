@extends('app.layout')

@section('content')


<!-- Form container -->
<div class="form-container container">
    <form action="{{ route('login') }}" method="POST" class="border col-6 col-sm-12">
        @csrf
        <!-- Group -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" id="email"
                class="@error('email') invalid @enderror">
            @error('email')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <!-- /Group -->
        <!-- Group -->
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="@error('password') invalid @enderror">
            @error('password')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <!-- /Group -->

        <div class="form-group">
            <label for="remember">Remember me:</label>
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        </div>

        @component('components.recaptcha')
        @endcomponent

        <!-- Submit -->
        <div class="form-group">
            <button type="submit">Login</button>
        </div>
    </form>
</div>
<!-- /Form container -->

@endsection