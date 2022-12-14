<div class="h-auto w-full">
    <div class="relative w-full py-10 px-4 bg-primary text-white flex justify-center items-center mb-2">
        <h2 class="text-4xl lg:text-6xl">Liste des clubs</h2>
    </div>
    <div class="flex justify-center my-2 m-auto w-11/12 sm:w-9/12 md:w-7/12 lg:w-6/12">
        <label for="query" class="sr-only">Recherche</label>
        <input autofocus type="search" class="inputForm focus:outline-none focus:shadow-outline w-full my-1 mx-2"
            id="query" placeholder="Nom du club, ville, code postal..." wire:model="query">
    </div>

    <div class="m-auto my-2 w-11/12 sm:w-9/12 md:w-7/12 lg:w-7/12 text-sm text-primary">
        @foreach ($clubs as $key => $club)
            <a href="{{ route('clubs.show', $club) }}" class="-intro-y">
                <div class="flex flex-col mb-1 w-full border rounded-md shadow-md">
                    <div
                        class="relative flex flex-row items-center overflow-hidden rounded-lg"
                        style="animation-delay: {{ $key }}00ms;">
                        <div class="w-12 m-2 z-10">
                            <div class="logo h-8 w-8">
                                <img class="object-contain" src="{{ asset($club->logo) }}"
                                    alt="Logo de {{ $club->name }}">
                            </div>
                        </div>
                        <div class="py-1 w-full overflow-hidden ml-2 z-10">
                            <p class="truncate font-bold">{{ $club->name }}</p>
                            <p>{{ $club->zip_code }} {{ $club->city }}</p>
                            {{-- @if ($club->region)
                                <p>{{ $club->region->name }}</p>
                            @endif --}}
                        </div>
                        <div class="absolute -bottom-7 -right-7 transform -rotate-45 z-0">
                            <div class="h-2 w-36 mb-1 border shadow" style="background-color: {{ $club->primary_color }};"></div>
                            <div class="h-2 w-36 border shadow" style="background-color: {{ $club->secondary_color }};"></div>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
        @if ($clubs->isEmpty())
            <div class="bg-primary text-white p-4">
                <div class="flex flex-col items-center justify-center mb-3">
                    <p class="text-2xl">OUPS ! </p>
                    <img src="{{ asset('images/gifs/fail.gif') }}" alt="">
                    <p>Renouvelle ta recherche ou demande l'ajout du club !</p>
                </div>

                <div class="flex flex-col items-center justify-around lg:flex-row" role="alert">
                    @auth
                        <div class="text-sm my-2 flex-grow mx-3">
                            <form class="my-4 m-auto" action="{{ route('contacts.askNewTeam') }}" method="POST">
                                @csrf
                                <div>
                                    <label for="region">Quelle r??gion ?</label>
                                    <select class="inputForm focus:outline-none focus:shadow-outline w-full my-1"
                                        name="region" id="region" wire:model="region" :value="old('region')"
                                        autocomplete="region" required>
                                        <option>Choisis la r??gion</option>
                                        @foreach ($regions as $region)
                                            <option value="{{ $region->name }}">{{ $region->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="departement">Quel d??partement ?</label>
                                    <select class="inputForm focus:outline-none focus:shadow-outline w-full my-1"
                                        name="departement" id="departement" wire:model="departement"
                                        :value="old('departement')" autocomplete="departement" required>
                                        <option>Choisis le d??partement</option>
                                        @foreach ($departements as $departement)
                                            <option value="{{ $departement->name }}">{{ $departement->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="nomClub">Quel est le nom du club ?</label>
                                    <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1"
                                        type="text" name="nomClub" id="nomClub" wire:model="nomClub"
                                        placeholder="Essaie d'??tre pr??cis ;)">
                                </div>
                                <div class="float-right">
                                    <input class="btn btnSecondary" type="submit" value="Envoyer">
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center">
                            <a href="/login" class="btn btnSecondary">Connecte toi</a>
                            <p>pour sugg??rer un club</p>
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
