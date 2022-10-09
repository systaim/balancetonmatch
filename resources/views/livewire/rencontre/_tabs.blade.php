<div class="flex flex-col items-center justify-center">
    <div class="flex items-center justify-end mx-2 flex-1 mb-2">
        @if ($commentateurs->count() > 0)
            <div class="text-xs border rounded-sm p-2 shadow-md mr-2 bg-secondary text-primary">
                {{-- <img
                src="https://img.icons8.com/external-flaticons-lineal-color-flat-icons/32/000000/external-fans-football-soccer-flaticons-lineal-color-flat-icons-3.png" /> --}}
                <p>Spectateurs : <span class="ml-1 font-bold">{{ $visitors }}</span></p>
            </div>
            <button type="button" wire:click='merci'
                class="text-xs border rounded-sm p-2 shadow-md bg-primary text-secondary">
                <p>
                    <span class="mr-1 py-0.5 px-1 rounded-sm bg-secondary text-primary">
                        {{ $match->commentateur->merci }}</span>
                    "Merci"
                    <span class="ml-1"> 🎉</span>
                </p>
            </button>
        @endif
    </div>
    <div class="flex justify-between">
        <div class="flex-1 flex justify-center text-sm">
            <button type="button"
                class="mx-1 border {{ $open_share ? 'border-primary bg-secondary text-primary' : '' }} px-2 py-1 mb-1 rounded-sm shadow-lg"
                wire:click.prefetch="openTab('share')">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z"
                        clip-rule="evenodd" />
                </svg>
            </button>
            {{-- <button type="button"
            class="mx-1 border {{ $open_galerie ? 'border-primary bg-secondary text-primary' : '' }} px-2 py-1 mb-1 rounded-sm shadow-lg"
            wire:click.prefetch="openTab('galerie')">
            Photos
        </button> --}}
            <button type="button"
                class="mx-1 border {{ $open_match ? 'border-primary bg-secondary text-primary' : '' }} px-2 py-1 mb-1 rounded-md shadow-lg"
                wire:click.prefetch="openTab('match')">
                Match
            </button>
            <button type="button"
                class="mx-1 border {{ $open_infos ? 'border-primary bg-secondary text-primary' : '' }} px-2 py-1 mb-1 rounded-md shadow-lg"
                wire:click.prefetch="openTab('infos')">
                Infos
            </button>
            <button type="button"
                class="mx-1 border {{ $open_compos ? 'border-primary bg-secondary text-primary' : '' }} px-2 py-1 mb-1 rounded-md shadow-lg"
                wire:click.prefetch="openTab('compos')">
                Compos
            </button>
        </div>
    </div>

</div>
