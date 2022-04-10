{{-- @if ($commentateur) --}}
<div class="flex text-sm">
    <div class="my-3 bg-primary p-2 text-secondary flex-1 m-2 w-1/2">
        <h4 class="mb-2">Commenté en direct par</h4>
        <p>
            {{ $commentateur ? $commentateur->user->pseudo : 'Non commenté' }}
            @if ($commentateur)
                <span
                    class=" bg-secondary text-primary px-1 rounded shadow-sm">{{ $commentateur->user->nb_commentaires }}
                </span>
            @endif
        </p>
    </div>
    <div class="my-3 bg-primary p-2 text-secondary flex-1 m-2 w-1/2">
        <div class="flex items-center mb-2">
            <h4>Lieu du match</h4>
            <button type="button" wire:click="openStoreLieu">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
            </button>
        </div>
        @if ($open_store_lieu)
            <div>
                <input type="text" wire:model='lieu' class="inputForm text-sm">
                <button type="button" class="btn btnSecondary" wire:click="storeLieu">Valider</button>
            </div>
        @endif
        <p>
            {{ $match->location ? $match->location : 'non renseigné' }}
        </p>
    </div>
</div>

{{-- @endif --}}
