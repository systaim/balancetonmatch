@extends('layout')
@section('content')

@if (session('status'))
<div class="mb-4 font-medium text-sm text-green-600">
    {{ session('status') }}
</div>
@endif

<h2 class="text-center bg-primary text-secondary text-2xl py-1 my-4 rounded">Se connecter</h2>
<form action="{{ route('login') }}" method="post">
    @csrf
    <div class="bg-primary rounded-lg relative text-white my-12 p-3">
        <div class="flex flex-col">
            <label for="email">{{ __('Email') }}</label>
            <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="email" name="email" :value="old('email')" required autofocus>
        </div>
        <div class="flex flex-col">
            <label for="password">{{ __('Password') }}</label>
            <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="password" name="password" required autocomplete="current-password">
        </div>
        <div class="flex items-center">
            <input type="checkbox" class="form-checkbox" name="remember">
            <span class="ml-2 text-sm">{{ __('Remember me') }}</span>
        </div>
        <div class="flex justify-between items-center">
            @if (Route::has('password.request'))
            <a class="underline text-sm" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif
            <button class="btn btnPrimary">
                {{ __('Login') }}
            </button>
        </div>
    </div>
</form>
@endsection