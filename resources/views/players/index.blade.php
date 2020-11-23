@extends('layout')
@section('content')
<a href="{{route('clubs.show', $club) }}">
    <div class="flex flex-col justify-center items-center mb-4">
        <div class="logo h-16 w-16 m-4">
            <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{$club->numAffiliation}}.jpg" alt="logo">
        </div>
        <div class="bg-primary text-secondary rounded-lg">
            <h2 class="mx-2 text-xl">{{ $club->name }}</h2>
        </div>
        <div>
            <p>← Retour page club</p>
        </div>
    </div>
</a>
<div class="my-8">
    <h3 class="text-center mt-4">Les joueurs</h3>
    @foreach($club->players as $player)
    @if($player->first_name != 'numéro')
    <div class=" bg-primary text-white rounded-lg relative my-2 flex flex-row p-3">
        @livewire('update-player', ['player' => $player])
        <div class="flex flex-col">
            <div>
                <h4 class="capitalize text-secondary">{{ $player->first_name}} <span class="uppercase">{{ $player -> last_name}}</span></h4>
            </div>
            <div>
                <p>{{ $player->position}}</p>
                <p>né le {{ date('d/m/Y',strtotime($player->date_of_birth)) }}</p>
            </div>
        </div>
    </div>
    @endif
    @endforeach
</div>
<div>
    <a href="{{ route('clubs.players.create', $club) }}">
        <p class="btn btnPrimary">Ajouter un joueur <span>➤</span></p>
    </a>
</div>

@endsection