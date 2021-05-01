<div class="h-auto w-full">
    <div class="relative w-full py-10 px-4 bg-primary text-white flex justify-center items-center mb-6">
        <h2 class="text-4xl lg:text-6xl">Liste des clubs</h2>
    </div>
    <div class="flex justify-center my-8 m-auto w-11/12 sm:w-9/12 md:w-7/12 lg:w-6/12">
        <label for="query" class="sr-only">Search</label>
        <input autofocus type="search" class="inputForm focus:outline-none focus:shadow-outline w-full my-1 mx-2"
            id="query" placeholder="Nom du club, ville, code postal..." wire:model="query">
    </div>

    <div class="m-auto my-8 w-11/12 sm:w-9/12 md:w-7/12 lg:w-7/12">
        @foreach ($clubs as $key => $club)
            <a href="{{ route('clubs.show', $club) }}">
                <div class="flex flex-col mb-3 w-full">
                    <div id="listMatchs" class="relative flex flex-row items-center bg-primary overflow-hidden"
                        style="animation-delay: {{ $key }}00ms;">
                        <div class="w-16 m-2 z-10">
                            <div class="logo h-12 w-12">
                                <img class="object-contain"
                                    src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $club->numAffiliation }}.jpg">
                            </div>
                        </div>
                        <div class=" py-2 w-full text-secondary overflow-hidden ml-2 z-10">
                            <p class="truncate font-bold">{{ $club->name }}</p>
                            <p>{{ $club->zip_code }} {{ $club->city }}</p>
                            @if ($club->region)
                                <p>{{ $club->region->name }}</p>
                            @endif
                        </div>
                        <div class="absolute -bottom-7 -right-7 transform -rotate-45 z-0">
                            <div class="h-2 w-36 mb-1" style="background-color: {{ $club->primary_color }};"></div>
                            <div class="h-2 w-36" style="background-color: {{ $club->secondary_color }};"></div>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
        @if ($clubs->isEmpty())
            <div class="bg-primary text-white p-4">
                <div class="flex flex-col items-center justify-center mb-3">
                    <p class="text-2xl">OUPS ! </p>
                    <p>Renouvelle ta recherche ou demande l'ajout du club !</p>
                </div>

                <div class="flex flex-col-reverse items-center justify-around lg:flex-row" role="alert">
                    <img src="{{ asset('images/gifs/fail.gif') }}" alt="">
                    @auth
                        <div class="text-sm my-2 flex-grow mx-3">
                            <form class="my-4 m-auto" action="{{ route('contacts.askNewTeam') }}" method="POST">
                                @csrf
                                <div>
                                    <label for="region">Quelle région ?</label>
                                    <select class="inputForm focus:outline-none focus:shadow-outline w-full my-1"
                                        name="region" id="region" wire:model="region" :value="old('region')"
                                        autocomplete="region" required>
                                        <option>Choisis la région</option>
                                        @foreach ($regions as $region)
                                            <option value="{{ $region->name }}">{{ $region->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="departement">Quel district ?</label>
                                    <select class="inputForm focus:outline-none focus:shadow-outline w-full my-1"
                                        name="departement" id="departement" wire:model="departement"
                                        :value="old('departement')" autocomplete="departement" required>
                                        <option>Choisis le district</option>
                                        @foreach ($departements as $departement)
                                            <option value="{{ $departement->name }}">{{ $departement->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="nomClub">Quel est le nom du club ?</label>
                                    <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="text"
                                        name="nomClub" id="nomClub" wire:model="nomClub"
                                        placeholder="Essaie d'être précis ;)">
                                </div>
                                <div class="float-right">
                                    <input class="btn btnSecondary" type="submit" value="Envoyer">
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center">
                            <a href="/login" class="btn btnSecondary">Connecte toi</a>
                            <p>pour suggérer un club</p>
                        </div>
                    @endauth
                </div>
            </div>
        @endif
    </div>
    <div class="mx-1">
        {{ $clubs->links() }}
    </div>
</div>
