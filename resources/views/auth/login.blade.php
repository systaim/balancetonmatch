@extends('layout')
@section('content')
@if (session('status'))
<div class="mb-4 font-medium text-sm text-green-600">
    {{ session('status') }}
</div>
@endif
<div class="m-4">
    <h2 class="text-primary text-center text-xl py-4">Se connecter</h2>
    <form action="{{ route('login') }}" method="post">
        @csrf
        <div class=" relative  my-2 p-3">
            <div class="flex flex-col">
                <label for="email">{{ __('Email') }}</label>
                <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="email">
            </div>
            <div class="flex flex-col">
                <label for="password">{{ __('Password') }}</label>
                <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="password" name="password" required>
            </div>
            <div class="flex items-center">
                <input type="checkbox" class="form-checkbox" name="remember">
                <span class="ml-2 text-sm">{{ __('Remember me') }}</span>
            </div>
            <div class="flex justify-between items-center">
                <div class="flex flex-col">
                    @if (Route::has('password.request'))
                    <a class="underline text-sm" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                    @endif
                    <a class="underline text-sm" href="/register">Pas de compte ?</a>
                </div>

                <button class="btn btnPrimary">
                    {{ __('Login') }}
                </button>
            </div>
        </div>
    </form>
</div>

@endsection