<div id="backTeam" class="relative flex flex-col items-center justify-start lg:bg-fixed" style="background-image: url({{ asset($club->bg_path) }});">
    @include('clubs.logo')
    @if($club->bg_path == null || $club->bg_path == "")
    <p class="absolute top-1/2 text-xl px-3 py-2 bg-primary text-secondary rounded-lg font-bold">Pas encore de photo pour ce club</p>
    @endif

    @canany(['isManager', 'isSuperAdmin', 'isAdmin'])

    @if($bouton == 1)
    <form wire:submit.prevent="coverTeam" class="relative z-50 bg-gray-200 py-2 px-4 rounded-lg border border-gray-500 border-dashed my-8 w-11/12 md:w-7/12 lg:w-5/12">
        <p class="text-center py-2 font-bold">Photo de couverture</p>
        <div class="flex flex-col items-center">
            <label class="cursor-pointer my-4 btn border border-black" for="cover">Choisir une photo 📷</label>
            <input class="hidden" type="file" name="cover" id="cover" wire:model="cover">
            @error('photo')
            <span class="error">
                {{ $message }}
            </span>
            @enderror
            <div class="hidden font-bold py-4" wire:loading wire:target="cover">Téléchargement...</div>
            <div class="flex flex-col sm:flex-row justify-center w-full px-12">
                <button class="btn btnSuccess" type="submit" wire:loading.remove wire:target="cover">Sauvegarder</button>
                @if($club->bg_path != null)
                <button class="absolute top-2 right-3 bg-danger text-white border border-black font-bold text-xs px-2 py-1 rounded-md" wire:click="deleteCover">Supprimer <i class="far fa-times-circle"></i></button>
                <button type="button" class="text-red-700 font-bold ml-2" wire:loading.remove wire:target="cover" wire:click="clickButton">Annuler</button>
                @endif
            </div>
        </div>
    </form>
    @else
    <button class="absolute top-2 right-3 lg:right-10 bg-success font-bold text-xs px-2 py-1 rounded-md" wire:click="clickButton">Modifier 📷</button>
    @endif

    @endcanany




    <div class="absolute  bottom-0 mb-20 lg:mb-10 h-10 w-10 bg-secondary pt-3 rounded-full flex justify-center border border-black">
        <a href="#infos">
            <i class="animate-bounce fas fa-arrow-down text-xl"></i>
        </a>
    </div>

</div>