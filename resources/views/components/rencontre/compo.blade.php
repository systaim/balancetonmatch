


<div
    class="relative flex py-1 px-2 my-1 {{ $compo->id === $selectedCompoId ? 'bg-primary text-secondary mb-0' : '' }}">
    <p class="my-2">{{ $compo->player_id <= 16 ? '' : $numero + 1 . '-' }} {{ $compo->player->full_name }}</p>
    <button type="button" class="ml-3" wire:click="selectedCompoId({{ $compo->id }})">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
            <path
                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
        </svg>
    </button>
</div>
@if ($compo->id === $selectedCompoId)
    <div class="bg-primary p-2 relative">
        <button type="button" wire:click="setCompoIdToNull" class="absolute -top-9 right-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-600" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                    clip-rule="evenodd" />
            </svg>
        </button>
        @if ($openCreatePlayer)
            <form wire:submit.prevent="storePlayer({{ $match->homeClub->id }}, {{ $compo->id }})">
                {{-- <p class="text-xs text-secondary">Ou crée le</p> --}}
                <div class="flex flex-col m-1">
                    <label class="text-xs text-secondary">Prénom</label>
                    <input type="text" wire:model="prenom" required
                        class="border-l-0 border-r-0 border-t-0 text-sm focus:ring-0" placeholder="prénom">
                </div>
                <div class="flex flex-col m-1">
                    <label class="text-xs text-secondary">Nom</label>
                    <input type="text" wire:model="nom_de_famille" required
                        class="border-l-0 border-r-0 border-t-0 text-sm focus:ring-0" placeholder="nom de famille">
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="btn bg-white text-primary text-xs" wire:click="openCreatePlayer">
                        Retour
                    </button>
                    <button type="submit" class="btn btnSecondary text-xs">Sauver</button>
                </div>
            </form>
        @else
            <div class="flex flex-col">
                <label class="text-xs text-secondary">Choisis un joueur</label>
                <select class="border-none text-sm focus:ring-0 m-1 text-primary" wire:model="joueur_choisi">
                    <option value="">Choisir un joueur</option>
                    @foreach ($match->homeClub->players as $player)
                        <option value="{{ $player->id }}"
                            {{ $match->homeClub->player_of_this_match($match->id, $player->id) }}>
                            {{ $player->full_name }}
                            {{ $match->homeClub->player_of_this_match($match->id, $player->id) == 'disabled' ? '(Déjà présent)' : '' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end">
                <button type="button" class="btn btnSecondary text-xs"
                    wire:click="storePlayer({{ $match->homeClub->id }}, {{ $compo->id }})">
                    Je valide
                </button>
            </div>

            <div class="border-t flex justify-center">
                <button type="button" class="btn btnPrimary text-xs" wire:click="openCreatePlayer">
                    Ou je le crée en mode #rapide
                </button>
            </div>
        @endif
    </div>
@endif
