<div class="flex flex-col justify-center items-center p-3 md:w-1/2 mr-2 hover:shadow-2xl">
    @auth
        <div>
            @if ($user->isfavoriTeam($club))
                <div class="flex items-center">
                    <button type="button" wire:model="heart" wire:click="myTeam({{ $club->id }})">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-700 cursor-pointer" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </button>
                    {{-- <i wire:model="heart" class="{{ $heart }} fa-heart text-3xl text-red-700 cursor-pointer bg-secondary p-4 rounded-full" wire:click="myTeam({{ $club->id }})"></i> --}}
                </div>
            @else
                <div class="flex items-center">
                    <button type="button" wire:model="heart" wire:click="myTeam({{ $club->id }})">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-700 cursor-pointer"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    {{-- <i wire:model="heart" class="{{ $heart }} fa-heart text-3xl text-red-700 cursor-pointer bg-secondary p-4 rounded-full" wire:click="myTeam({{ $club->id }})"></i> --}}
                </div>
            @endif
            <div>
                @if (session()->has('messageMyTeam'))
                    <div wire:loading.class.remove="alertFavori"
                        class="absolute inline-block bg-black text-white text-xs p-2 rounded-lg alertFavori z-50">
                        {{ session('messageMyTeam') }}
                    </div>
                @endif
            </div>
        </div>
    @else
        <div>
            <button type="button" wire:model="heart" wire:click="clickLogin">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-700 cursor-pointer"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                        clip-rule="evenodd" />
                </svg>
            </button>
            <i class="far fa-heart text-3xl text-red-700 cursor-pointer bg-secondary p-4 rounded-full"
                wire:click="clickLogin"></i>
            @if ($login)
                <div wire:loading.class.remove="alertFavori"
                    class="absolute inline-block bg-black text-white text-xs p-2 rounded-lg alertFavori z-50">
                    <a href="/login">
                        <p>{{ $login }}</p>
                        <p>Connecte toi <i class="fas fa-arrow-right"></i></p>
                    </a>
                </div>
            @endif
        </div>
    @endauth
    <div>
        @if ($nbrFavoris == 0)
            <p>Sois le premier fan</p>
        @elseif($nbrFavoris > 0)
            @if ($nbrFavoris == 1)
                <p>Suivi par {{ $nbrFavoris }} fan</p>
            @else
                <p>Suivi par {{ $nbrFavoris }} fans</p>
            @endif
        @endif
    </div>
</div>
