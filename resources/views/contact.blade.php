@extends('layout')
@section('content')
<div>
    <form class="text-white flex flex-col lg:w-6/12 m-auto" action="{{ route('contacts.store') }}" method="POST">
        @csrf
        <label for="prenom">prenom</label>
        <input class="inputForm text-primary" type="text" name="prenom" id="prenom" value="{{ Auth() ? Auth()->user()->first_name : '' }}">

        <label for="nom">nom</label>
        <input class="inputForm text-primary" type="text" name="nom" id="nom" value="{{ Auth() ? Auth()->user()->last_name : '' }}">

        <label for="email">mail</label>
        <input class="inputForm text-primary @error('email') is-invalid @enderror" type="email" name="email" id="email" value="{{ Auth() ? Auth()->user()->email : '' }}">
        @error('email')
        <div class="">{{ $message }}</div>
        @enderror

        <label for="message">Message</label>
        <textarea class="inputForm text-primary @error('message') is-invalid @enderror" name="message" id="message" rows="10"></textarea>
        @error('message')
        <div class="">{{ $message }}</div>
        @enderror

        <input class="btn btnPrimary" type="submit" value="Envoyer">
    </form>
</div>
@endsection