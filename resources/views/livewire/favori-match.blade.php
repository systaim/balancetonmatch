<div class="absolute left-6">
    @auth
    <div>
        @if ($user->isfavoriMatch($match))
        <div>
            <i wire:model="star" class="{{ $star }} fa-star cursor-pointer text-red-700 text-xl" wire:click="myMatch({{ $match->id }})"></i>
        </div>
        @else
        <div>
            <i wire:model="star" class="{{ $star }} fa-star cursor-pointer text-red-700 text-xl" wire:click="myMatch({{ $match->id }})"></i>
        </div>
        @endif
    </div>
    @else
    <div>
        <i class="far fa-star cursor-pointer text-red-700 text-xl" wire:click="clickLogin"></i>
        @if($login)
        <div wire:loading.class.remove="alertFavori" class="bg-black text-white text-xs p-2 rounded-lg alertFavori z-50">
            <p>{{ $login }}</p>
            <p>Veuillez vous connecter</p>
        </div>
        @endif
    </div>
    @endauth
    <div>
        @if (session()->has('messageMyMatch'))
        <div wire:loading.class.remove="alertFavori" class="bg-black text-white text-xs p-2 rounded-lg alertFavori z-50">
            {{ session('messageMyMatch') }}
        </div>
        @endif
    </div>
</div>