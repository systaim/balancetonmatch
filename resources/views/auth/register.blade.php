@extends('layout')
@section('content')
<form method="POST" action="{{ route('register') }}">
    @csrf
    <div>
        <h2 class="text-center bg-primary text-secondary text-2xl py-1 my-4 rounded">S'enregistrer</h2>
        <form method="POST" action="{{ route('register') }}">
            <div class="bg-primary rounded-lg relative text-white my-2 p-3">
                <div class="flex flex-col">
                    <label for="last_name">Nom de famille</label>
                    <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="text" name="last_name" id="last_name" :value="old('last_name')" required autocomplete="last_name">
                    @error('last_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label for="first_name">Prénom</label>
                    <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="text" name="first_name" id="first_name" :value="old('first_name')" required autocomplete="first_name">
                    @error('first_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label for="Peudo">Pseudo</label>
                    <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="text" name="pseudo" id="pseudo" :value="old('pseudo')" required autocomplete="pseudo">
                    @error('pseudo')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label for="email">Email</label>
                    <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="email" name="email" id="email" :value="old('email')" required autocomplete="email">
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label for="date_of_birth">Date de naissance</label>
                    <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="date" name="date_of_birth" id="date_of_birth" :value="old('date_of_birth')" autocomplete="date_of_birth">
                    @error('birthDate')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label for="password">Mot de passe</label>
                    <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="password" name="password" required autocomplete="new-password">
                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label for="passwordConfirm">Mot de passe à confirmer</label>
                    <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="password" name="password_confirmation" required autocomplete="new-password">
                </div>
                <div class="flex justify-between items-center">
                    <a class="ml-2" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                    <button class="btn btnSecondary">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</form>

<!-- <form method="POST" action="{{ route('register') }}">
    @csrf
    <div>
        <x-jet-label value="{{ __('Last_name') }}" />
        <x-jet-input class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="last_name" />
    </div>

    <div class="mt-4">
        <x-jet-label value="{{ __('First_name') }}" />
        <x-jet-input class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autocomplete="first_name" />
    </div>

    <div class="mt-4">
        <x-jet-label value="{{ __('Pseudo') }}" />
        <x-jet-input class="block mt-1 w-full" type="text" name="pseudo" :value="old('pseudo')" required autocomplete="pseudo" />
    </div>

    <div class="mt-4">
        <x-jet-label value="{{ __('Email') }}" />
        <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
    </div>

    <div class="mt-4">
        <x-jet-label value="{{ __('Date de naissance') }}" />
        <x-jet-input class="block mt-1 w-full" type="date" name="date_of_birth" :value="old('date')" required />
    </div>

    <div class="mt-4">
        <x-jet-label value="{{ __('Password') }}" />
        <x-jet-input class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
    </div>

    <div class="mt-4">
        <x-jet-label value="{{ __('Confirm Password') }}" />
        <x-jet-input class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
    </div>

    <div class="flex items-center justify-end mt-4">
        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
            {{ __('Already registered?') }}
        </a>
        <x-jet-button class="ml-4">
            {{ __('Register') }}
        </x-jet-button>
    </div>
</form> -->
@endsection