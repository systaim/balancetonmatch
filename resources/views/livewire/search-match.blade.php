<div class="relative flex flex-col w-6/12 m-auto">
    <div>
        <input wire:model="search" class="inputForm w-full" type="text" name="search" placeholder="Nom du club, de la ville ou code postal">
        <i class="absolute text-xl mt-3 mr-3 top-0 right-0 text-primary fas fa-search"></i>
    </div>
    <div class="absolute w-full top-13 z-10 h-auto">
        @foreach($matches as $match)
        <div>
            <a href="{{ route('matches.show',$match) }}">
                <div class="text-primary bg-white px-2 py-2 hover:bg-blue-200">
                    <p class="text-xs text-center">{{ $match->competition->name }}</p>
                    <p class="text-center text-sm">{{ $match->date_match->formatLocalized('%d/%m/%y') }} {{ $match->date_match->formatLocalized('%H:%M')}}</p>
                    <div class="grid grid-cols-3">
                        <div class="col-span-1 flex flex-col items-center">
                            <div class="logo h-12 w-12 cursor-pointer m-4 border-2 border-primary">
                                <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->homeClub->numAffiliation }}.jpg" alt="logo">
                            </div>
                            <p class="truncate">{{ $match->homeClub->name }}</p>
                        </div>
                        <p class="text-center text-4xl font-bold col-span-1 flex items-center justify-center">VS</p>
                        <div class="col-span-1 flex flex-col items-center">
                            <div class="logo h-12 w-12 cursor-pointer m-4 border-2 border-primary">
                                <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->awayClub->numAffiliation }}.jpg" alt="logo">
                            </div>
                            <p class="col-span-1 text-center truncate">{{ $match->awayClub->name }}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
        @if(count($matches) == 0 && strlen($search) >= 3)
        <div class="bg-white py-4">
            <p class="text-center">Tu n'as pas trouvé ce que tu voulais ?</p>
            <a class="flex justify-center" href="{{ route('matches.create') }}">
                <button class="btn btnSecondary">Crée un match</button>
            </a>
        </div>

        @endif
    </div>
</div>