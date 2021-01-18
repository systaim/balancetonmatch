<div class="h-auto w-full">
    <div class="flex justify-center my-8">
        <h2 class="titlePage">Rechercher un club</h2>
    </div>
    <div class="flex justify-center my-8 m-auto w-11/12 sm:w-9/12 md:w-7/12 lg:w-6/12">
        <label for="query" class="sr-only">Search</label>
        <input autofocus type="search" class="inputForm focus:outline-none focus:shadow-outline w-full my-1 mx-2" id="query" placeholder="Ex: Nantes" wire:model="query">
    </div>
    <div class="m-auto my-8 w-11/12 sm:w-9/12 md:w-7/12 lg:w-7/12">
        @foreach ($clubs as $club)
        @if($clubs)
        <a href="{{ route('clubs.show', $club) }}">
            <div class="flex flex-col mb-3 w-full">
                <div class="flex flex-row items-center bg-primary rounded-lg">
                    <div class="w-16 m-2">
                        <div class="logo h-12 w-12">
                            <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $club->numAffiliation }}.jpg">
                        </div>
                    </div>
                    <div class=" py-2 w-full text-secondary overflow-hidden ml-2">
                        <p class="truncate font-bold">{{ $club->name}}</p>
                        <p>{{ $club->city }}</p>
                        @if($club->region)
                        <p>{{ $club->region->name }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </a>
        @endif
        @endforeach
        @if($clubs->isEmpty())
        <div>
            <div class="text-center p-2 bg-indigo-800 items-center text-indigo-100 leading-none rounded-lg lg:rounded-full flex flex-col lg:inline-flex" role="alert">
                <p class="text-sm my-2">Vous pouvez renouveler votre recherche avec moins de lettres pour élargir le résultat</p>
            </div>
        </div>
        @endif
    </div>
    <div wire:loading.remove wire:target="searchByName" class="mb-5 text-center">
        <p>{{$messageNoClub}}</p>
    </div>
    <div class="mx-1">
        {{ $clubs->links() }}
    </div>
</div>