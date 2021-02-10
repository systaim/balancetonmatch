<div class="ml-2 flex justify-center items-center">
    @auth
    <div>
        @if ($user->isfavoriTeam($club))
        <div>
            <i wire:model="heart" class="{{ $heart }} fa-heart text-3xl text-red-700 cursor-pointer" wire:click="myTeam({{ $club->id }})"></i>
        </div>
        @else
        <div class="flex items-center">
            <i wire:model="heart" class="{{ $heart }} fa-heart text-3xl text-red-700 cursor-pointer" wire:click="myTeam({{ $club->id }})"></i>
        </div>
        @endif
        <div>
            @if (session()->has('messageMyTeam'))
            <div wire:loading.class.remove="alertFavori" class="absolute inline-block bg-black text-white text-xs p-2 rounded-lg alertFavori z-50">
                {{ session('messageMyTeam') }}
            </div>
            @endif
        </div>
    </div>
    @else
    <div>
        <i class="far fa-heart text-3xl text-red-700 cursor-pointer" wire:click="clickLogin"></i>
        @if($login)
        <div wire:loading.class.remove="alertFavori" class="absolute inline-block bg-black text-white text-xs p-2 rounded-lg alertFavori z-50">
            <a href="/login">
                <p>{{ $login }}</p>
                <p>Connecte toi <i class="fas fa-arrow-right"></i></p>
            </a>
        </div>
        @endif
    </div>
    @endauth
    <div class="ml-4">
        @if($nbrFavoris == 0)
        <p>Sois le premier fan</p>
        @elseif($nbrFavoris > 0)
        @if($nbrFavoris == 1)
        <p>Suivi par {{ $nbrFavoris }} fan</p>
        @else
        <p>Suivi par {{ $nbrFavoris }} fans</p>
        @endif
        @endif
    </div>
</div>