<div class="h-auto">
    <h2 class="titlePage">Liste des clubs</h2>
    <!-- <form wire:submit.prevent="searchByName">
        <div class="relative flex flex-wrap w-10/12 items-stretch mb-3 m-auto">
            <input autofocus type="text" wire:model.defer="name" placeholder="Recherche" class="focus px-3 py-3 placeholder-gray-800 text-gray-700 relative bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full pr-10" />
            <span class="z-10 h-full leading-snug font-normal text-center text-gray-900 absolute bg-transparent rounded text-base items-center justify-center w-8 right-0 pr-3 py-3">
                <input type="submit" value="🔍">
            </span>
        </div>
    </form> -->
    <!-- <div wire:loading wire:target="searchByName" class="text-center m-auto bg-primary text-secondary mx-5 px-2 hidden">
        Loading...
    </div> -->
    <div class="flex justify-center">
        <label for="query" class="sr-only">Search</label>
        <input autofocus type="search" class="inputForm focus:outline-none focus:shadow-outline w-full my-1 mx-2" id="query" placeholder="Ex: Nantes" wire:model="query">
    </div>
    <div>
        @if (session()->has('message'))
        <div class="text-center p-2 bg-indigo-800 items-center text-indigo-100 leading-none rounded-lg lg:rounded-full flex flex-col lg:inline-flex" role="alert">
            <p class="font-bold">{{ session('message') }}</p>
            <p class="text-sm my-2">Vous pouvez renouveler votre recherche avec moins de lettres pour élargir le résultat</p>
        </div>
        @endif
    </div>
    <div class="m-auto my-8 w-11/12">
        @foreach ($clubs as $club)
        @if($clubs)
        <a href="{{ route('clubs.show', $club) }}">
            <div class="flex flex-col mb-3 w-full">
                <div class="flex flex-row items-center bg-primary rounded-full">
                    <div class="w-16 m-2">
                        <div class="logo h-12 w-12">
                            <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $club->numAffiliation }}.jpg">
                        </div>
                    </div>
                    <div class=" py-2 w-full text-secondary overflow-scroll ml-2">
                        <p class="truncate">{{ $club->name}}</p>
                    </div>
                </div>
            </div>
        </a>
        @endif
        @endforeach
    </div>
    <div wire:loading.remove wire:target="searchByName" class="mb-5 text-center">
        <p>{{$messageNoClub}}</p>
    </div>
    <div class="mx-12">
        {{ $clubs->links() }}
    </div>
</div>