@extends('app.layout')

@section('content')



<div class="header-margin"></div>

<!-- Form container -->
<div class="form-container container">
    <form action="{{ route('register') }}" method="POST" class="border col-6 col-md-12">
        @csrf
        <!-- Group -->
        <div class="form-group">
            <label for="name">Username</label>
            <input type="text" name="name" value="{{ old('name') }}" id="name" class="@error('name') invalid @enderror">
            @error('name')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <!-- /Group -->
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
        <!-- Group -->
        <div class="form-group">
            <label for="password_confirmation">Confirm password</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                class="@error('password_confirmation') invalid @enderror">
            @error('password_confirmation')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <!-- /Group -->


      

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