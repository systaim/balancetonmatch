<div id="backTeam" class="relative flex flex-col items-center justify-start lg:bg-fixed mb-4"
    style="background-image: url({{ asset($club->bg_path) }});">
    @include('clubs.logo')
    @if ($club->bg_path == null || $club->bg_path == '' || $club->bg_path == 'images/default-team.jpg')
        <p class="absolute top-1/2 text-xl px-3 py-2 bg-primary text-secondary font-bold shadow-outline rounded-lg">
            Pas encore de photo officielle pour ce club
        </p>
        @can('update-club', $club)
            <button class="lg:right-10 bg-white border border-success font-bold text-xs px-2 py-1 rounded-md"
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
                                wire:click="deleteCover">Supprimer <i class="far fa-times-circle"></i></button>
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
            <i class="animate-bounce fas fa-arrow-down text-xl"></i>
        </a>
    </div>
</div>
