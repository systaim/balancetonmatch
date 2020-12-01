<div class="mb-6">
    <div class="relative text-center flex justify-center font-bold">
        <div class="absolute left-0 md:left-6">
            @livewire('favori-match', ['user' => $user, 'match' => $match])
        </div>
        <div class="flex justify-center">
            <p class="px-4 bg-primary text-secondary rounded-tl-md">{{ $match->date_match->formatLocalized('%d/%m/%y')}}</p>
            <p class="px-4 bg-primary text-secondary rounded-tr-md">{{ $match->date_match->formatLocalized('%H:%M')}}</p>
        </div>
    </div>
    <a href="{{route('matches.show',$match) }}">
        <div class="grid grid-cols-12">
            <div class="col-span-5 overflow-hidden">
                <div class="bg-primary p-2 text-secondary flex flex-col rounded-l-lg md:flex-row md:items-center md:rounded-l-full xl:text-xl xl:font-bold">
                    <div class="flex justify-center">
                        <div class="logo h-8 w-8 sm:h-16 sm:w-16 xl:w-24 xl:h-24 cursor-pointer mr-1">
                            <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->homeClub->numAffiliation }}.jpg" alt="logo">
                        </div>
                    </div>
                    <div>
                        <p class="truncate text-center">{{ $match->homeClub->name }}</p>
                    </div>
                </div>
            </div>
            <div class="col-span-2 bg-gradient-to-r from-primary to-secondary flex flex-row justify-center items-center">
                @if($match->live == 'attente')
                <p class="bg-indigo-700 text-xs text-center text-white rounded-md px-2 shadow-md border-b-2 border-r-2 border-white">A VENIR</p>
                @elseif($match->live != 'finDeMatch' && $match->live != 'reporte' && $match->live != 'attente')
                <p class="bg-red-700 text-xs text-white rounded-md px-2 shadow-md border-b-2 border-r-2 border-white">LIVE</p>
                @elseif($match->live == 'reporte')
                <p class="bg-green-600 text-xs text-white rounded-md px-2 shadow-md border-b-2 border-r-2 border-white">REPORTÉ</p>
                @elseif($match->live == 'finDeMatch')
                <div class="flex justify-center">
                    <div class="bg-white rounded-sm mr-1">
                        <p class="flex justify-center w-4 text-3xl px-4 font-bold">{{$match->home_score}}</p>
                    </div>
                    <div class="bg-white rounded-sm ml-1 z-10">
                        <p class="flex justify-center w-4 text-3xl px-4 font-bold">{{$match->away_score}}</p>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-span-5 overflow-hidden z-0">
                <div class="bg-secondary p-2 text-primary flex flex-col rounded-r-lg md:flex-row-reverse md:items-center md:rounded-r-full xl:text-xl xl:font-bold">
                    <div class="flex justify-center">
                        <div class="logo h-8 w-8 sm:h-16 sm:w-16 xl:w-24 xl:h-24 cursor-pointer ml-1">
                            <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->awayClub->numAffiliation }}.jpg" alt="logo">
                        </div>
                    </div>
                    <div>
                        <p class="truncate text-center sm:text-right">{{ $match->awayClub->name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>