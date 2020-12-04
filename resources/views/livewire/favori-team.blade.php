<div class="ml-2">
    @auth
    <div class="flex">
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
            <div wire:loading.class.remove="alertFavori" class="bg-black text-white text-xs p-2 rounded-lg alertFavori">
                {{ session('messageMyTeam') }}
            </div>
            @endif
        </div>
    </div>
    @else
    <div>
        <i class="far fa-heart text-3xl text-red-700 cursor-pointer" wire:click="clickLogin"></i>
        @if($login)
        <div wire:loading.class.remove="alertFavori" class="bg-black text-white text-xs p-2 rounded-lg alertFavori">
            <p>{{ $login }}</p>
            <p>Connecte toi</p>
        </div>
        @endif
    </div>
    @endauth
</div>