<div class="grid grid-cols-12 pb-4">
            <div class="col-span-5 overflow-hidden">
                <div class="bg-primary p-2 text-secondary flex flex-col rounded-l-lg">
                    <div class="flex justify-center">
                        <div class="logo h-8 w-8">
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
                <p class="z-10 bg-indigo-700 text-xs text-center text-white rounded-md px-2 shadow-md border-b-2 border-r-2 border-white">A VENIR</p>
                @elseif($match->live == 'début')
                <p class="z-10 bg-red-700 text-xs text-white rounded-md px-2 shadow-md border-b-2 border-r-2 border-white">LIVE</p>
                @elseif($match->live == 'reporte')
                <p class="z-10 bg-green-600 text-xs text-white rounded-md px-2 shadow-md border-b-2 border-r-2 border-white">REPORTÉ</p>
                @else
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
                <div class="bg-secondary p-2 text-primary flex flex-col rounded-r-lg">
                    <div class="flex justify-center">
                        <div class="logo h-8 w-8 cursor-pointer">
                            <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->awayClub->numAffiliation }}.jpg" alt="logo">
                        </div>
                    </div>
                    <div>
                        <p class="truncate text-center">{{ $match->awayClub->name }}</p>
                    </div>
                </div>
            </div>
        </div>