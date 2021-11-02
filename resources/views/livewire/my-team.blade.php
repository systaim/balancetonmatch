<div class="flex flex-col justify-center items-center p-3 md:w-1/2 mr-2 hover:shadow-2xl" wire:click="itsMyTeam">
    <div>
        <button type="button" wire:model="star" wire:click="itsMyTeam({{ $club->id }})">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-700 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
              </svg>
        </button>
        {{-- <i wire:model="star"
            class="{{ $star }} fa-star {{ $animation }} text-3xl text-red-700 cursor-pointer bg-secondary p-4 rounded-full"
            wire:click="itsMyTeam({{ $club->id }})"></i> --}}
    </div>
    <div>
        @auth
            @if ($user->club_id == $club->id)
                <p class="text-sm">{{ $message }}</p>
            @elseif ($user->club_id == null)
                <p class="text-sm">C'est ta team ? Clique sur l'étoile</p>
            @else
                <p class="text-sm">{{ $message }}</p>
            @endif
        @else
            <a href="/login">
                <div class="text-center flex flex-col justify-center">
                    <p class="text-sm">C'est ta team ? connecte toi →</p>
                </div>
            </a>
        @endauth

    </div>
</div>
