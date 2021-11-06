
    <button type="button" class="px-3 py-2 rounded-md shadow-xl bg-white flex items-center m-3" wire:click="myTeam({{ $club->id }})">
        @auth
            @if ($user->isfavoriTeam($club))
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-3 text-danger" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                        clip-rule="evenodd" />
                </svg>
                <p class="text-sm">Je suis ce club</p>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-3 text-danger" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                <p class="text-sm">Je veux le suivre</p>
            @endif
        @else
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-3 text-danger" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
            <a class="text-sm" href="/login">Je veux le suivre</a>
        @endauth
        <div class="ml-2">
            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                {{ $nbrFavoris }}
              </span>
        </div>
    </button>
{{-- </div> --}}
