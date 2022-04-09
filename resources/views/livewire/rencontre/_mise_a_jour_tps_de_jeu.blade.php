    <div class="relative">
        <div class="flex flex-col items-center text-sm">
            {{-- <h3 class="text-center mt-3">Temps de jeu</h3> --}}
            <button type="button"
                class="btn btnSecondary animate__animated animate__flash animate__infinite animate__slower"
                @click="tps_de_jeu = true">
                {{ $name_of_periode }}
            </button>
        </div>
    </div>

    <div @keydown.window.escape="tps_de_jeu = false" x-show="tps_de_jeu" class="fixed z-10 inset-0 overflow-y-auto"
        aria-labelledby="modal-title" x-ref="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

            <div x-show="tps_de_jeu" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                x-description="Background overlay, show/hide based on modal state."
                class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="tps_de_jeu = false"
                aria-hidden="true">
            </div>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>

            <div x-show="tps_de_jeu" x-transition:enter="ease-out duration-300"
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
                            @if ($match->live == 'attente')
                                Le match a t-il commencé à l'heure ?
                            @else
                                Es-tu sûr ?
                            @endif
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                @if ($match->live == 'attente')
                                    Si non, renseigne l'heure à laquelle le match a commencé pour faire correspondre le
                                    chrono
                                @else
                                    Tu valides bien ton choix ?
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                    @if ($match->live == 'attente')
                        <button type="button" class="btn" @click="modif_debut_de_match = true">
                            Non
                        </button>
                        <button type="button" class="btn btnPrimary" @click="tps_de_jeu = false, modif_debut_de_match = false"
                            wire:click="miseAJourPeriodeDuMatch(1)">
                            Oui
                        </button>
                    @else
                        <button type="button" class="btn" @click="tps_de_jeu = false, modif_debut_de_match = false">
                            Non
                        </button>
                        <button type="button" class="btn btnPrimary" @click="tps_de_jeu = false, modif_debut_de_match = false"
                            wire:click="miseAJourPeriodeDuMatch">
                            Oui
                        </button>
                    @endif
                </div>
                <div x-show="modif_debut_de_match">
                    <form wire:submit.prevent="saveNewDatetime('start_match')" class="flex flex-col">
                        <label for="new_date_match" class="mt-3 text-sm text-gray-600">A quelle heure a t-il commencé
                            ?</label>
                        <input type="datetime-local" wire:model="new_date_match" class="border rounded-md text-sm">
                        <button type="submit" class="btn text-sm" @click="tps_de_jeu = false">Je valide le
                            changement</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
