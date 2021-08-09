<div class="relative z-10">
    @auth
    <div>
        @if ($user && $user->isfavoriMatch($match))
        <div>
            <i wire:model="star" class="{{ $star }} fa-star cursor-pointer text-red-700 text-4xl" wire:click="myMatch({{ $match->id }})"></i>
        </div>
        @else
        <div>
            <i wire:model="star" class="{{ $star }} fa-star cursor-pointer text-red-700 text-4xl" wire:click="myMatch({{ $match->id }})"></i>
        </div>
        @endif
    </div>
    @else
    <div>
        <i class="far fa-star cursor-pointer text-red-700 text-4xl" wire:click="clickLogin"></i>
        @if($login)
        <a href="/login">
            <div wire:loading.class.remove="alertFavori" class="absolute bg-black text-white text-xs p-2 rounded-lg alertFavori z-50">
                <p>{{ $login }}</p>
                <p>Connecte toi</p>
            </div>
        </a>
        @endif
    </div>
    @endauth
    <div>
        @if (session()->has('messageMyMatch'))
        <div wire:loading.class.remove="alertFavori" class="absolute bg-black text-white text-xs p-2 rounded-lg alertFavori z-50">
            {{ session('messageMyMatch') }}
        </div>
        @endif
    </div>
</div>