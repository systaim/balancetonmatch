<div id="backTeam" class="relative flex flex-col items-center justify-start lg:bg-fixed mb-4"
    style="background-image: url({{ asset($club->bg_path) }});">
    @include('clubs.logo')
    @if ($club->bg_path == null || $club->bg_path == '' || $club->bg_path == 'images/default-team.jpg')
        <p class="text-base px-3 py-2 bg-primary text-white font-bold rounded-lg my-8">
            Photo de couverture en attente...
        </p>
        @can('update-club', $club)
            <button class="lg:right-10 bg-white border border-success font-bold text-sm px-2 py-1 rounded-md"
                wire:click="clickButton">
                Ajouter une photo de couverture 📷
            </button>
        @endcan
    @endif

    @can('update-club', $club)

        @if ($bouton == 1)
            <form wire:submit.prevent="coverTeam"
                class="relative z-10 bg-gray-200 py-2 px-4 rounded-lg border border-gray-500 border-dashed my-8 w-11/12 md:w-7/12 lg:w-5/12">
                <p class="text-center py-2 font-bold">Photo de couverture</p>
                <div class="flex flex-col items-center">
                    <label class="cursor-pointer my-4 btn border border-black" for="cover">Choisir une photo 📷</label>
                    <input class="hidden" type="file" name="cover" id="cover" wire:model="cover">
                    @if ($cover)
                        Photo Preview:
                        <img src="{{ $cover->temporaryUrl() }}">
                    @endif
                    @error('photo')
                        <span class="error">
                            {{ $message }}
                        </span>
                    @enderror
                    <div class="hidden font-bold py-4" wire:loading wire:target="cover">Téléchargement...</div>
                    <div class="flex flex-col sm:flex-row justify-center w-full px-12">
                        <button class="btn btnSuccess" type="submit" wire:loading.remove
                            wire:target="cover">Sauvegarder</button>
                        @if ($club->bg_path != null)
                            <button
                                class="absolute top-2 right-3 bg-danger text-white border border-black font-bold text-xs px-2 py-1 rounded-md"
                                wire:click="deleteCover">Supprimer
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                            <button type="button" class="text-red-700 font-bold ml-2" wire:loading.remove
                                wire:target="cover" wire:click="clickButton">Annuler</button>
                        @endif
                    </div>
                </div>
            </form>
        @else
            @if ($club->bg_path != 'images/default-team.jpg')
                <button
                    class="absolute top-2 right-3 lg:right-10 bg-white border border-success font-bold text-xs px-2 py-1 rounded-md"
                    wire:click="clickButton">
                    Modifier 📷
                </button>
            @endif
        @endif
    @endcan
    <div class="absolute bottom-20 h-10 w-10 bg-secondary pt-3 rounded-full flex justify-center border border-black">
        <a href="#infos">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 animate-bounce " viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd"
                    d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z"
                    clip-rule="evenodd" />
            </svg>
            {{-- <i class="animate-bounce fas fa-arrow-down text-xl"></i> --}}
        </a>
    </div>
</div>
