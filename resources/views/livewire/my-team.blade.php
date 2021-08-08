<div class="flex flex-col justify-center items-center p-3 md:w-1/2 mr-2 hover:shadow-2xl"
    wire:click="itsMyTeam({{ $club->id }})">
    <div>
        <i wire:model="star"
            class="{{ $star }} fa-star text-3xl text-red-700 cursor-pointer bg-secondary p-4 rounded-full"
            wire:click="itsMyTeam({{ $club->id }})"></i>
    </div>
    <div>
        @auth
            @if ($user->club_id == $club->id)
                <p>Je fais partie de ce club ! 💪</p>
            @else
                <p>C'est mon club !</p>
            @endif
        @else
            <div class="text-center flex flex-col justify-center">
                <p>C'est ta team ?</p>
            </div>
        @endauth

    </div>
</div>
