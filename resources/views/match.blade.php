<div x-data="{ open: false }">
    <div class="relative text-center flex justify-center font-bold">
        <div class="absolute top-4 left-0 md:left-6 z-50">
            @livewire('favori-match', ['user' => $user, 'match' => $match])
        </div>
    </div>
    <div class="relative my-2 p-2 bg-primary text-white rounded-lg cursor-pointer">
        @if(Auth::user() && $match->user_id == Auth::user()->id)
        <div class="bg-secondary w-6 h-6 absolute top-2 right-1 flex justify-center items-center rounded-full text-primary" @click="open= true">
            <div class="dotMenu"></div>
            <div class="absolute top-0 right-0 w-32 h-24 py-4 pl-6 bg-secondary shadow-xl rounded-lg" x-show="open" @click.away="open = false">
                <a class="w-full py-2" href="{{ route('matches.destroy', $match) }}" onclick="event.preventDefault();
                        document.getElementById('delete-match').submit();">Effacer</a>
            </div>
            <form id="delete-match" action="{{ route('matches.destroy', $match) }}" method="POST">
                @method('DELETE')
                @csrf
            </form>
        </div>
        @endif
        <a href="{{route('matches.show',$match) }}">
            <div class="">
                <div class="text-center flex justify-center font-bold">
                    <p class="px-4 bg-primary text-secondary rounded-tl-md">{{ $match->date_match->formatLocalized('%d/%m/%y')}}</p>
                    <p class="px-4 bg-primary text-secondary rounded-tr-md">{{ $match->date_match->formatLocalized('%H:%M')}}</p>
                </div>
                <div class="grid grid-cols-12">
                    <div class="flex flex-col justify-center items-center col-span-5 overflow-hidden">
                        <div class="logo h-12 w-12 lg:h-16 lg:w-16 cursor-pointer">
                            <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->homeClub->numAffiliation }}.jpg" alt="logo">
                        </div>
                        <div class="ml-2">
                            <p class="text-xs md:text-base md:font-bold truncate">{{$match->homeClub->name}}</p>
                        </div>
                    </div>
                    <div class="col-span-2 flex flex-row justify-center items-center">
                        @if($match->live == 'attente')
                        <div class="flex items-center justify-center text-secondary">
                            <p class="text-3xl p-2 font-bold">VS</p>
                        </div>
                        @elseif($match->live == 'reporte')
                        <p class="bg-green-600 text-xs text-white rounded-md px-2 shadow-md border-b-2 border-r-2 border-white">REPORTÉ</p>
                        @elseif($match->live != 'reporte' || $match->live != 'attente')
                        <div class="flex justify-center text-black">
                            <div class="bg-white rounded-sm mr-1">
                                <p class="flex justify-center w-4 text-3xl px-4 font-bold">{{$match->home_score}}</p>
                            </div>
                            <div class="bg-white rounded-sm ml-1 z-10">
                                <p class="flex justify-center w-4 text-3xl px-4 font-bold">{{$match->away_score}}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="flex flex-col justify-center items-center col-span-5 overflow-hidden">
                        <div class="logo h-12 w-12 lg:h-16 lg:w-16 cursor-pointer">
                            <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->awayClub->numAffiliation }}.jpg" alt="logo">
                        </div>
                        <div class="ml-2">
                            <p class="text-xs md:text-base md:font-bold truncate">{{$match->awayClub->name}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>