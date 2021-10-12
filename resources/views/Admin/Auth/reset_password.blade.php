@extends('Layouts.Public.app')
@section('content')
<form action="/password/reset" method="post" role="form" class="form">
@csrf
<input type="text" name="token" value="{{ $token }}">
    <div class="form-group mt-3">
        
        <input type="email" class="form-control" name="email" value="{{ $email}}" required>
    </div>
    <input type="text" name="password" placeholder="password">
    <input type="text" name="password_confirmation" placeholder="password confirmation">
    @error('password')
        <div class="my-3">
            <div class="error-message">{{ $message }}</div>
        </div>
    @enderror

    @error('password_confirmation')
        <div class="my-3">
            <div class="error-message">{{ $message }}</div>
        </div>
    @enderror

    @error('email')
        <div class="my-3">
            <div class="error-message">{{ $message }}</div>
        </div>
    @enderror
    
    
    <div class="text-center"><button type="submit">Login</button></div>
</form>
@endsection