<div class="relative z-10">
    @auth
        <div>
            @if ($user && $user->isfavoriMatch($match))
                <div>
                    <button type="button" wire:model="star" wire:click="myMatch({{ $match->id }})">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-700 cursor-pointer"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
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
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
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
                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
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
        
        {{-- @if (session()->has('messageMyMatch'))
            <div wire:loading.class.remove="alertFavori"
                class="absolute bg-black text-white text-xs p-2 rounded-lg alertFavori z-50 w-36">
                {{ session('messageMyMatch') }}
            </div>
        @endif --}}
    </div>
</div>
