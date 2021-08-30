<div class="m-8 relative">
    <form submit:prevent="logoSave">
        <label for="inputLogo">
            <input type="file" name="inputLogo" id="inputLogo" wire:model="inputLogo">
        </label>
        <div class="hidden font-bold py-1 px-2 bg-primary text-white rounded-md" wire:loading wire:target="inputLogo">
            Téléchargement...</div>
        @if ($inputLogo)
            <div class="bg-primary text-white rounded-lg flex flex-col items-center justify-center p-2">
                Prévisualisation :
                <img class="w-36 m-3 rounded-lg" src="{{ $inputLogo->temporaryUrl() }}">
                <input class="btn btnSecondary" type="submit" value="Enregistrer">
        @endif
        @error('inputLogo')
            <span class="error">
                {{ $message }}
            </span>
        @enderror
    </form>
</div>
