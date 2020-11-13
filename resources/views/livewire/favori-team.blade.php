<div>
    @auth
    <div>
        @if (session()->has('messageMyTeam'))
        <div wire:loading.class.remove="alertFavori" class="absolute top-16 left-14 bg-black text-white text-xs p-2 rounded-lg alertFavori">
            {{ session('messageMyTeam') }}
        </div>
        @endif
    </div>
    <div class="absolute top-10 left-10">
        @if ($user->isfavoriTeam($club))
        <div class="flex flex-col items-center">
            <i wire:model="heart" class="{{ $heart }} fa-heart text-3xl text-red-700 cursor-pointer" wire:click="myTeam({{ $club->id }})"></i>
        </div>
        @else
        <div>
            <i wire:model="heart" class="{{ $heart }} fa-heart text-3xl text-red-700 cursor-pointer" wire:click="myTeam({{ $club->id }})"></i>
        </div>
        @endif
    </div>
    @else
    <div class="absolute top-10 left-10 w-full">
        <i class="far fa-heart text-3xl text-red-700 cursor-pointer" wire:click="clickLogin"></i>
        @if($login)
        <div wire:loading.class.remove="alertFavori" class="absolute bg-black text-white text-xs p-2 rounded-lg alertFavori">
            <p>{{ $login }}</p>
            <p>Veuillez vous connecter</p>
        </div>
        @endif
    </div>
    @endauth
</div>