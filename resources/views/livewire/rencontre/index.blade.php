<div class="min-h-screen sm:w-10/12 md:w-9/12 lg:w-6/12 mx-auto mt-2" wire:poll.3s x-data="{
    tps_de_jeu: false,
    modif_debut_de_match: false,
    update_datetime_match: false,
    open_update_score: false,
    become_commentator: false

}">
    <div wire:offline class="w-full">
        <div class="bg-orange-600 text-white py-2 flex justify-center items-center w-full">
            {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 3l8.735 8.735m0 0a.374.374 0 11.53.53m-.53-.53l.53.53m0 0L21 21M14.652 9.348a3.75 3.75 0 010 5.304m2.121-7.425a6.75 6.75 0 010 9.546m2.121-11.667c3.808 3.807 3.808 9.98 0 13.788m-9.546-4.242a3.733 3.733 0 01-1.06-2.122m-1.061 4.243a6.75 6.75 0 01-1.625-6.929m-.496 9.05c-3.068-3.067-3.664-7.67-1.79-11.334M12 12h.008v.008H12V12z" />
            </svg> --}}
            <div class="offline"></div>
            <div class="ml-2 text-sm">
                <p>Vous รชtes hors ligne...</p>
                <p>En attente de reconnexion</p>
            </div>
        </div>
    </div>

    @if (Auth::check() && !$commentateur && $commentaires_match_ouverts)
        <div class="flex flex-col items-center text-sm">
            <button type="button" class="btn btnPrimary" @click="become_commentator = true">
                <p class=" animate__animated animate__flipInY"> Je veux commenter ๐</p>
            </button>
        </div>
    @elseif(!$commentateur && $commentaires_match_ouverts)
        <div class="flex flex-col items-center text-sm">
            <a href="/login">
                <button type="button" class="btn btnPrimary">
                    <p class=" animate__animated animate__flipInY"> Je me connecte pour commenter ๐</p>
                </button>
            </a>
        </div>
        {{-- @else
        <div class="flex flex-col items-center text-sm my-3">
            <div class="animate__animated animate__flipInY bg-secondary text-primary px-2 py-1">
                <p>Revenez avant le match pour commenter ๐</p>
            </div>
        </div> --}}
    @endif
    <div x-show="become_commentator" class="mb-12 py-8">
        <p class="text-center text-sm">Accepte tu vraiment la mission ? </p>
        <div class="flex justify-between">
            <button type="button" class="btn w-1/2 flex-1" @click="become_commentator = false">
                Finalement non ๐
            </button>
            <button type="button" class="btn btnPrimary w-1/2 flex-1" @click="become_commentator = false"
                wire:click="devenirCommentateur">
                Bien sรปr ๐
            </button>
        </div>
    </div>

    <div x-show="update_datetime_match" class="flex justify-center flex-col items-center" style="display: none">
        <p class="text-sm">Modifier l'heure et le jour de match</p>
        <form wire:submit.prevent="saveNewDatetime" class="flex flex-col">
            <label for="new_date_match" class="mt-3 text-sm text-gray-600">Quand et ร? quelle heure
                ?</label>
            <input type="datetime-local" wire:model="new_date_match" class="border rounded-md text-sm">
            <button type="submit" class="btn btnSecondary text-sm" @click="update_datetime_match = false">
                Je valide le changement</button>
        </form>
    </div>

    <div class="bg-primary text-secondary px-3 py-1 text-sm flex justify-between rounded-sm my-3">
        <div>
            <div class="flex">
                @if ($match->region_id)
                    <h2>{{ $match->region->name }}</h2>
                @endif
                @if ($match->departement_id)
                    <h2 class="ml-1">{{ $match->departement->name }}</h2>
                @endif
            </div>
            {{ $match->competition->name }}
            @if ($match->divisionRegion)
                {{ $match->divisionRegion->name }}
            @endif
            @if ($match->divisionDepartment)
                > {{ $match->divisionDepartment->name }}
            @endif
            @if ($match->group)
                > {{ $match->group->name }}
            @endif
        </div>
        <div>
            <div class="flex">
                <p class="mr-2">{{ $match->date_match->formatLocalized('%H:%M') }}</p>
                <p>{{ $match->date_match->formatLocalized('%d/%m/%y') }}</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-3 mb-3">
        <div class="flex flex-col items-center justify-center flex-1 py-4 overflow-hidden"
            style="background-color: {{ $match->homeClub->primary_color }}; color:{{ $match->homeClub->secondary_color == $match->homeClub->primary_color ? '#011526' : $match->homeClub->secondary_color }}">
            <a target="blank" href="{{ route('clubs.show', $match->homeClub->id) }}">
                <div class="logo h-16 w-16 cursor-pointer shadow-lg">
                    <img class="object-contain" src="{{ asset($match->homeClub->logo) }}"
                        alt="Logo de {{ $match->homeClub->abbreviation }}">
                </div>
            </a>
            <p class="text-center truncate">{{ $match->homeClub->initial }}</p>
        </div>
        <div class="flex flex-col justify-center items-center flex-1"
            style="background: rgb(2,0,36);
                background: linear-gradient(90deg, {{ $match->homeClub->primary_color }} 0%, {{ $match->awayClub->primary_color }} 100%);">
            <div class="flex text-4xl font-bold">
                <div class="flex flex-col items-center justify-center">
                    @if ($corriger_le_score)
                        <label for="inputHomeScore" class="sr-only">Score ร? domicile</label>
                        <input type="text" name="inputHomeScore" id="inputHomeScore" wire:model="inputHomeScore"
                            class="w-8 p-0 text-center text-4xl">
                    @else
                        <div class="rounded-md bg-white p-1 m-1.5 shadow-lg w-10 flex justify-center">
                            <p id="homescore" class="text-4xl">{{ $home_score ?? 0 }}</p>
                        </div>
                    @endif
                </div>
                {{-- <div class=" flex flex-col justify-center">-</div> --}}
                <div class="flex flex-col items-center justify-center">
                    @if ($corriger_le_score)
                        <label for="inputAwayScore" class="sr-only">Score ร? l'extรฉrieur</label>
                        <input type="text" name="inputAwayScore" id="inputAwayScore" wire:model="inputAwayScore"
                            class="w-8 p-0 text-center text-4xl">
                    @else
                        <div class="rounded-md bg-white p-1 m-1.5 shadow-lg w-10 flex justify-center">
                            <p class="away-score text-4xl">{{ $away_score ?? 0 }}</p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="flex flex-col text-sm items-center justify-center">
                @if ($corriger_le_score)
                    <button type="button" class="btn btnSecondary" wire:click="storeScore">Valider</button>
                @endif
                @if ($match->live == 'attente')
                    <p>En attente</p>
                @elseif($match->live == 'finDeMatch')
                    <p>Terminรฉ</p>
                @else
                    <p class="text-xl animate__animated animate__heartBeat animate__infinite font-bold">
                        {{ $minute }}'</p>
                @endif
            </div>
            @if (Auth::check() &&
                $commentateur &&
                $commentateur->user_id == Auth::id() &&
                $commentaires_match_ouverts &&
                $variable_tps_pour_commenter)
                @include('livewire.rencontre._mise_a_jour_tps_de_jeu')
            @endif
        </div>
        <div class="flex flex-col items-center justify-center flex-1 py-4 overflow-hidden"
            style="background-color: {{ $match->awayClub->primary_color }}; color:{{ $match->awayClub->secondary_color == $match->awayClub->primary_color ? '#011526' : $match->awayClub->secondary_color }}">
            <a target="blank" href="{{ route('clubs.show', $match->awayClub->id) }}">
                <div class="logo h-16 w-16 cursor-pointer shadow-lg">
                    <img class="object-contain" src="{{ asset($match->awayClub->logo) }}"
                        alt="Logo de {{ $match->awayClub->abbreviation }}">
                </div>
            </a>
            <p class="text-left truncate">{{ $match->awayClub->initial }}</p>
        </div>
    </div>
    @include('livewire.rencontre._tabs')
    @if (!$match->validate_score)
        @auth
            <div class="flex text-sm rounded-sm overflow-hidden my-3">
                @if ($match->live != 'attente' &&
                    $match->live != 'mitemps' &&
                    $match->live != 'finDeMatch' &&
                    $match->date_match->diffInMinutes(now(), false) > -5 &&
                    ($commentateur && $commentateur->user_id == Auth::id()) &&
                    $match->date_match->diffInMinutes(now(), false) < 120)
                    <button type="button" class="w-full py-3 bg-secondary text-center text-gray-900 rounded-sm"
                        wire:click="openMenuComment">
                        {{ $open_menu_comment ? 'Fermer' : 'Je commente' }}
                    </button>
                @elseif($match->date_match->diffInMinutes(now(), false) >= 120)
                    <button type="button" class="w-full py-3 bg-primary text-center text-secondary"
                        wire:click="corrigerLeScore">
                        {{ $corriger_le_score ? 'Fermer' : 'Je renseigne le score' }}
                    </button>
                    <button type="button" class="w-full py-3 bg-secondary text-center text-gray-900"
                        wire:click="openMenuComment">
                        {{ $open_menu_comment ? 'Fermer' : 'Ou je renseigne le fil du match' }}
                    </button>
                @endif
                @if ($match->live == 'attente' && !$commentateur)
                    <button type="button" class="w-full py-3 bg-primary text-center text-secondary"
                        @click="update_datetime_match = !update_datetime_match">
                        Je modifie la date du match
                    </button>
                @endif
            </div>
        @else
            <div class="text-sm w-full bg-primary my-3">
                @if (!$commentaires_match_ouverts)
                    <a href="/login">
                        <button type="button" class="w-full py-3 bg-secondary text-center text-primary px-2">
                            Je me connecte pour renseigner les infos du match
                        </button>
                    </a>
                @endif
            </div>
        @endauth
    @endif
    @if ($open_menu_comment)
        @include('livewire.rencontre._menu_com')
    @endif
    @if ($open_match)
        <div>
            @foreach ($comments->sortBy(['type_comments', 'minute']) as $comment)
                <x-new-commentaire :comment="$comment" :match="$match" :reactions="$reactions" :commentateurs="$commentateurs"
                    :commentIdToDelete="$commentIdToDelete">
                </x-new-commentaire>
            @endforeach
        </div>
    @endif

    @if ($open_infos)
        @include('livewire.rencontre._infos')
    @endif

    @if ($open_compos)
        @include('livewire.rencontre._compos')
    @endif

    @if ($open_share)
        @include('livewire.rencontre._share')
    @endif

    @if ($open_galerie)
        @include('livewire.rencontre._galerie')
    @endif
    {{-- <div @keydown.window.escape="become_commentator = false" x-show="become_commentator" style="display: none
        class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" x-ref="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

            <div x-show="become_commentator" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" x-description="Background overlay, show/hide based on modal state."
                class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="become_commentator = false"
                aria-hidden="true">
            </div>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">โ</span>

            <div x-show="become_commentator" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-description="Modal panel, show/hide based on modal state."
                class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <div>
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-5">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Souhaites tu vraiment devenir le commentateur ?
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                C'est sรปr ?
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                    <button type="button" class="btn" @click="become_commentator = false">
                        Non
                    </button>
                    <button type="button" class="btn btnPrimary" @click="become_commentator = false"
                        wire:click="devenirCommentateur">
                        Oui
                    </button>
                </div>
            </div>
        </div>
    </div> --}}
</div>
