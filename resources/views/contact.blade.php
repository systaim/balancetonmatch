@extends('layout')
@section('content')
<div class="">
    <form class="text-white flex flex-col lg:w-6/12 m-auto" action="{{ route('contacts.store') }}" method="POST">
        <h2 class="my-4 lg:w-6/12 text-center text-2xl bg-primary rounded-lg text-secondary px-2 py-1 inline-block m-auto">Formulaire de contact</h2>
        @csrf
        <div class="flex flex-col mt-4">
            <label class="text-primary font-bold" for="prenom">prenom</label>
            <input class="relative inputForm text-primary" type="text" name="prenom" id="prenom" value="{{ Auth::check() ? Auth()->user()->first_name : '' }}">
            @error('prenom')
            <div class="text-danger font-bold">{{ $message }}</div>
            @enderror
        </div>
        <div class="flex flex-col mt-4">
            <label class="text-primary font-bold" for="nom">nom</label>
            <input class="relative inputForm text-primary" type="text" name="nom" id="nom" value="{{ Auth::check() ? Auth()->user()->last_name : '' }}">
            @error('nom')
            <div class="text-danger font-bold">{{ $message }}</div>
            @enderror
        </div>
        <div class="flex flex-col mt-4">
            <label class="text-primary font-bold" for="email">mail</label>
            <input class="relative inputForm text-primary" type="email" name="email" id="email" value="{{ Auth::check() ? Auth()->user()->email : '' }}">
            @error('email')
            <div class="text-danger font-bold">{{ $message }}</div>
            @enderror
        </div>
        <div class="flex flex-col mt-4">
            <label class="text-primary font-bold" for="message">Message</label>
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