<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">

        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
        <div x-data="{photoName: null, photoPreview: null}" class="my-2 mx-4">
            <!-- Profile Photo File Input -->
            <input type="file" class="hidden" wire:model="photo" x-ref="photo" x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

            <x-jet-label for="photo" value="{{ __('Photo') }}" />

            <!-- Current Profile Photo -->
            <div class="mt-2" x-show="! photoPreview">
                <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
            </div>

            <!-- New Profile Photo Preview -->
            <div class="mt-2" x-show="photoPreview">
                <span class="block rounded-full w-20 h-20" x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                </span>
            </div>

            <button class="mt-2 mr-2 btn btnPrimary" type="button" x-on:click.prevent="$refs.photo.click()">
                {{ __('Select A New Photo') }}
            </button>

            @if ($this->user->profile_photo_path)
            <button type="button" class="mt-2 btn btnPrimary" wire:click="deleteProfilePhoto">
                {{ __('Remove Photo') }}
            </button>
            @endif

            <x-jet-input-error for="photo" class="mt-2" />
        </div>
        @endif

        <!-- nom -->
        <div class="my-2 mx-4">
            <x-jet-label for="last_name" value="Nom de Famille" />
            <x-jet-input id="last_name" type="text" class="mt-1 block w-full cursor-not-allowed" wire:model.defer="state.last_name" autocomplete="last_name" disabled />
            <x-jet-input-error for="last_name" class="mt-2" />
        </div>

        <!-- prenom -->
        <div class="my-2 mx-4">
            <x-jet-label for="prenom" value="Prénom" />
            <x-jet-input id="first_name" type="text" class="mt-1 block w-full cursor-not-allowed" wire:model.defer="state.first_name" autocomplete="first_name" disabled />
            <x-jet-input-error for="first_name" class="mt-2" />
        </div>

        <!-- pseudo -->
        <div class="my-2 mx-4">
            <x-jet-label for="pseudo" value="Pseudo" />
            <x-jet-input id="pseudo" type="text" class="mt-1 block w-full cursor-not-allowed" wire:model.defer="state.pseudo" autocomplete="pseudo" disabled />
            <x-jet-input-error for="pseudo" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="my-2 mx-4">
            <x-jet-label for="email" value="Email" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>

        <!-- club -->
        <div class="my-2 mx-4" wire:model.defer="state.club">
            <x-clubSelect />
            @error('club')
            <div class="alert danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- regions -->
        <div class="my-2 mx-4" wire:model.defer="state.region">
            <x-regionSelect />
            @error('region')
            <div class="alert danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- joueurs -->
        <div class="my-2 mx-4" wire:model.defer="state.player">
            <x-playerSelect />
            @error('player')
            <div class="alert danger">{{ $message }}</div>
            @enderror
        </div>

    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <button class="btn btnPrimary">
            {{ __('Save') }}
        </button>
    </x-slot>
</x-jet-form-section>