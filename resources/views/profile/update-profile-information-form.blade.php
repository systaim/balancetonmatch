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
            <div x-data="{photoName: null, photoPreview: null}"
                class="my-2 mx-4 p-4 flex flex-col items-center shadow-xl">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden" wire:model="photo" x-ref="photo" x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-jet-label class="sr-only" for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                        class="border-2 border-primary rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview">
                    <div class="flex flex-col items-center">
                        <span class="block rounded-full w-20 h-20"
                            x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                        </span>
                    </div>
                </div>

                <button class="mt-2 mr-2 btn btnPrimary" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Modifier ma photo') }}
                </button>

                @if ($this->user->profile_photo_path)
                    <button type="button" class="mt-2 btn btnPrimary" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </button>
                @endif

                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- devenir referent-club -->
        @if (Auth::user()->club && Auth::user()->role == 'guest')
            <div class="flex items-center justify-around my-2 mx-4 bg-primary p-4 text-white shadow-xl">
                <p>Je souhaite devenir un des référent de mon club</p>
                <form action="{{ route('contacts.becomeManager') }}" method="post" style="display: none;">
                    @csrf
                </form>
                <a id="btnDemande" class="btn btnSecondary">Demander</a>
            </div>

            <div id="form" class="hidden fixed z-50 inset-0 justify-center items-center"
                style="background-color: rgba(0,0,0,.5);">
                <div class="absolute top-10 right-10">
                    <a href="" class="text-4xl text-secondary font-bold">X</a>
                </div>
                <div class="p-10 bg-white w-full sm:w-11/12 md:w-9/12 lg:w-6/12 rounded-lg shadow-xl">
                    <form action="{{ route('contacts.becomeManager') }}" method="post">
                        @csrf
                        <h2 class="text-center mb-6">Es-tu sûr de vouloir faire la demande pour <span
                                class="font-bold">{{ Auth::user()->club->name }}</span> ?</h2>
                        <p>Avant de valider, vérifie bien ton adresse mail pour bien recevoir nos messages</p>
                        <p>On reviendra très vite vers toi !</p>
                        <div class="flex justify-end">
                            <a href="" class="btn mx-8">J'annule</a>
                            <input type="submit" class="btn btnSuccess" value="Je valide"></input>
                        </div>
                    </form>
                </div>
            </div>
        @endif


        <div class="flex flex-col">
            <!-- club -->

            <div
                class="my-4 lg:w-8/12 m-auto bg-primary p-4 text-white shadow-2xl flex flex-col justify-center items-center">
                <div class="flex flex-col items-center">
                    @if (Auth::user()->club)
                        <p class="text-center">Je suis licencié dans ce club :</p>
                        <div class="flex justify-center items-center">
                            <div class="flex-grow-0 logo h-16 w-16 m-2">
                                @if (Auth::user()->club->logo_path)
                                    <img class="object-contain" src="{{ asset(Auth::user()->club->logo_path) }}"
                                        alt="Logo de {{ Auth::user()->club->name }}">
                                @else
                                    <img class="object-contain"
                                        src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ Auth::user()->club->numAffiliation }}.jpg"
                                        alt="logo">
                                @endif
                            </div>
                            <p class="font-bold">{{ Auth::user()->club->name }}</p>
                        </div>
                        
                    @else
                        <p class="text-center">Je ne suis pas licencié dans un club</p>
                    @endif

                </div>
            </div>

            <div class="my-4 lg:w-8/12 m-auto bg-primary p-4 text-white shadow-2xl flex justify-center items-center">
                <p class="text-center">Ma région :</p>
                <div class="flex items-center">
                    @if (Auth::user()->region)
                        <p class="ml-3 font-bold">{{ Auth::user()->region->name }}</p>
                    @else
                        <p class="ml-3 font-bold">Pas de région sélectionnée</p>
                    @endif
                </div>
            </div>
            {{-- <!-- regions -->
            <div class="my-2 mx-4 bg-primary p-4 text-white shadow-xl" wire:model.defer="state.region">
                <x-regionSelect />
                @error('region')
                <div class="alert danger">{{ $message }}</div>
                @enderror
            </div> --}}
        </div>

        <!-- nom -->
        <div class="my-2 lg:w-8/12 m-auto">
            <x-jet-label for="last_name" value="Nom de Famille" />
            <x-jet-input id="last_name" type="text" class="mt-1 block w-full cursor-not-allowed"
                wire:model.defer="state.last_name" autocomplete="last_name" disabled />
            <x-jet-input-error for="last_name" class="mt-2" />
        </div>

        <!-- prenom -->
        <div class="my-2 lg:w-8/12 m-auto">
            <x-jet-label for="prenom" value="Prénom" />
            <x-jet-input id="first_name" type="text" class="mt-1 block w-full cursor-not-allowed"
                wire:model.defer="state.first_name" autocomplete="first_name" disabled />
            <x-jet-input-error for="first_name" class="mt-2" />
        </div>

        <!-- pseudo -->
        <div class="my-2 lg:w-8/12 m-auto">
            <x-jet-label for="pseudo" value="Pseudo" />
            <x-jet-input id="pseudo" type="text" class="mt-1 block w-full cursor-not-allowed"
                wire:model.defer="state.pseudo" autocomplete="pseudo" disabled />
            <x-jet-input-error for="pseudo" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="my-2 lg:w-8/12 m-auto">
            <x-jet-label for="email" value="Email" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>

        <!-- joueurs
        <div class="my-2 mx-4" wire:model.defer="state.player">
            <x-playerSelect />
            @error('player')
                                <div class="alert danger">{{ $message }}</div>
            @enderror
        </div> -->

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

<script>
    let form = document.getElementById("form");
    let btnDemande = document.getElementById("btnDemande");

    btnDemande.addEventListener("click", function() {
        form.classList.add("flex");
        form.classList.remove("hidden");
    });
</script>
