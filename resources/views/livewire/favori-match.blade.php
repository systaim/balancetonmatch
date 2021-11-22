<div class="relative z-10">
    @auth
        <div>
            @if ($user && $user->isfavoriMatch($match))
                <div>
                    <button type="button" wire:model="star" wire:click="myMatch({{ $match->id }})">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-700 cursor-pointer"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="{{ $star }}" />
                        </svg>
                    </button>
                    {{-- <i wire:model="star" class="{{ $star }} fa-star cursor-pointer text-red-700 text-2xl"
                        wire:click="myMatch({{ $match->id }})"></i> --}}
                </div>
            @else
                <div>
                    <button type="button" wire:model="star" wire:click="myMatch({{ $match->id }})">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-700 cursor-pointer" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="{{ $star }}" />
                        </svg>

                    </button>
                    {{-- <i wire:model="star" class="{{ $star }} fa-star cursor-pointer text-red-700 text-2xl"
                        wire:click="myMatch({{ $match->id }})"></i> --}}
                </div>
            @endif
        </div>
    @else
        <div>
            <button type="button" wire:click="clickLogin">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-700 cursor-pointer" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="{{ $star }}" />
                </svg>
            </button>
            @if ($login)
                <a href="/login">
                    <div wire:loading.class.remove="alertFavori"
                        class="absolute bg-black text-white text-xs p-2 rounded-lg alertFavori z-50">
                        <p>{{ $login }}</p>
                        <p>Connecte toi</p>
                    </div>
                </a>
            @endif
        </div>
    @endauth
    <div>
        @if (session()->has('messageMyMatch'))
            <div wire:loading.class.remove="alertFavori"
                class="absolute bg-black text-white text-xs p-2 rounded-lg alertFavori z-50 w-36">
                {{ session('messageMyMatch') }}
            </div>
        @endif
    </div>
</div>

