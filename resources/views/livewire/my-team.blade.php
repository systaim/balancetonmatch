<div class="flex flex-col justify-center items-center p-3 md:w-1/2 mr-2 hover:shadow-2xl" wire:click="itsMyTeam">
    <div>
        <i wire:model="star"
            class="{{ $star }} fa-star {{ $animation }} text-3xl text-red-700 cursor-pointer bg-secondary p-4 rounded-full"
            wire:click="itsMyTeam({{ $club->id }})"></i>
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
