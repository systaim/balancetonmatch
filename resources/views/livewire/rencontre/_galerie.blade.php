<div class="text-sm my-3 bg-primary p-2 text-secondary flex-1 m-2 flex justify-center">
    <h4 class="mb-2">Galerie</h4>
</div>
<div>
    <div class="flex flex-col items-center w-full">
        <button type="button" wire:click="openStorePhoto"
            class="text-sm btn btnPrimary">{{ $open_store_photo ? 'Fermer le menu' : 'Ajouter une photo' }}</button>
        @if ($open_store_photo)
            <form wire:submit.prevent="storePhotoMatch">
                <div class="{{ $photo_match ? 'hidden' : 'block' }} flex flex-col items-center">
                    <label for="cover-photo" class="sr-only">
                        Photo de match
                    </label>
                    <label for="photo_match">
                        <div
                            class="flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                    viewBox="0 0 48 48" aria-hidden="true">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <div
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>Ajouter une photo</span>
                                        <input id="photo_match" name="photo_match" type="file" wire:model="photo_match"
                                            class="sr-only">
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500">
                                    PNG, JPG, GIF
                                </p>
                            </div>
                        </div>
                    </label>
                </div>
                @error('photo_match')
                    <div class="bg-orange-200 text-orange-700 px-2 py-1 rounded-md">{{ $message }}</div>
                @enderror
                @if ($photo_match)
                    <div class="m-4 flex flex-col items-center text-sm">
                        Prévisualisation avant validation :
                        <img class="rounded-lg shadow-xl" src="{{ $photo_match->temporaryUrl() }}">
                    </div>
                    <div class="hidden" wire:loading wire:target="photo_match">
                        <svg class="animate-spin mr-2 h-5 w-5 text-primary" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </div>
                    <div class="flex justify-between">
                        <button type="button" class="btn btnPrimary" wire:click="storePhoto({{ $match->id }})">Je
                            l'envoi</button>
                        <button type="button" class="btn" wire:click="closeStorePhoto">J'annule</button>
                    </div>
                @endif
            </form>
        @endif
    </div>

    <div wire:ignore>
        <div class="splide" aria-label="galerie photos">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach ($photos as $photo)
                        <li class="splide__slide">
                            <div class="splide__slide__container">
                                <img src="{{ asset($photo->images) }}" alt="" class="rounded-lg m-1 w-full h-auto">
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div id="thumbnail-carousel" class="splide" aria-label="galerie photos">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach ($photos as $photo)
                        <li class="splide__slide">
                            <div class="splide__slide__container">
                                <img src="{{ asset($photo->images) }}" alt="" class="rounded-lg m-1 w-full h-auto">
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <script>
            new Splide('.splide', {
                type: 'fade',
                rewind: true,
                pagination: false,
                arrows: false,
            }).mount();
            new Splide('#thumbnail-carousel', {
                fixedWidth: 100,
                gap: 10,
                rewind: true,
                pagination: false,
            }).mount();
        </script>
    </div>
</div>
