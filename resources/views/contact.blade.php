@extends('layout')
@section('content')
<div class="">
    <div class="relative w-full py-10 px-4 bg-primary text-white flex justify-center items-center mb-6">
        <h2 class="text-4xl lg:text-6xl">Contact</h2>
    </div>
    <form class="flex flex-col w-11/12 lg:w-6/12 m-auto" action="{{ route('contacts.store') }}" method="POST">
        @csrf
        <div class="flex flex-col mt-4">
            <label class="text-primary font-bold" for="prenom">Mon prénom</label>
            <input class="relative inputForm text-primary" type="text" name="prenom" id="prenom" value="{{ Auth::check() ? Auth()->user()->first_name : '' }}">
            @error('prenom')
            <div class="text-danger font-bold">{{ $message }}</div>
            @enderror
        </div>
        <div class="flex flex-col mt-4">
            <label class="text-primary font-bold" for="nom">Mon nom</label>
            <input class="relative inputForm text-primary" type="text" name="nom" id="nom" value="{{ Auth::check() ? Auth()->user()->last_name : '' }}">
            @error('nom')
            <div class="text-danger font-bold">{{ $message }}</div>
            @enderror
        </div>
        <div class="flex flex-col mt-4">
            <label class="text-primary font-bold" for="email">Mon email</label>
            <input class="relative inputForm text-primary" type="email" name="email" id="email" value="{{ Auth::check() ? Auth()->user()->email : '' }}">
            @error('email')
            <div class="text-danger font-bold">{{ $message }}</div>
            @enderror
        </div>
        <div class="flex flex-col mt-4">
            <label class="text-primary font-bold" for="message">Mon message</label>
            <textarea class="relative inputForm text-primary" name="message" id="message" rows="10"></textarea>
            @error('message')
            <div class="text-danger font-bold">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <button class="btn btnPrimary float-right" type="submit">Envoyer</button>
        </div>

    </form>
</div>
@endsection