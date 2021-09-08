<div class="relative" x-data="{ open: false }">
    <div class="absolute h-full left-0 sm:left-2 z-40 text-center flex justify-center items-center font-bold">
        @livewire('favori-match', ['user' => Auth::user(), 'match' => $match])
    </div>
    <div class="relative my-2 p-2 bg-primary text-white shadow-lg cursor-pointer lg:rounded-lg">

        <div class="bg-secondary w-6 h-6 absolute top-2 right-1 flex justify-center items-center rounded-full text-primary z-40"
            @click="open= true">
            <div class="dotMenu"></div>
            <div class="absolute top-0 right-0 w-32 h-auto py-4 pl-6 bg-secondary shadow-xl rounded-lg" x-show="open"
                @click.away="open = false">
                {{-- <a class="w-full" href="{{ route('matches.edit', ['match' => $match]) }}">modifier</a> --}}
                @auth
                    @if ((Auth::user() && $match->user_id == Auth::user()->id && $match->live == 'attente') || Auth::user()->role == 'super-admin' || Auth::user()->role == 'admin')
                        <a class="w-full" href="{{ route('matches.destroy', $match) }}" onclick="event.preventDefault();
                                    document.getElementById('delete-match-{{ $match->id }}').submit();">Effacer</a>
                    @endif
                @endauth
            </div>
            <form id="delete-match-{{ $match->id }}" action="{{ route('matches.destroy', $match) }}" method="POST">
                @method('DELETE')
                @csrf
            </form>
        </div>
        <a href="{{ route('matches.show', [$match, Str::slug($match->slug, '-')]) }}">
            <div>
                <div class="text-center flex justify-center mb-2">
                    <p class="px-4 text-white">{{ $match->date_match->formatLocalized('%d/%m/%y') }}</p>
                    <p class="px-4 text-white">{{ $match->date_match->formatLocalized('%H:%M') }}</p>
                </div>
                <div class="grid grid-cols-12">
                    <div class="flex flex-col justify-center items-center col-span-5 overflow-hidden">
                        <div class="logo h-12 w-12 lg:h-16 lg:w-16 cursor-pointer">
                            @if ($match->homeClub->logo_path)
                                <img class="object-contain" src="{{ asset($match->homeClub->logo_path) }}"
                                    alt="Logo de {{ $match->homeClub->name }}">
                            @else
                                <img class="object-contain"
                                    src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->homeClub->numAffiliation }}.jpg"
                                    alt="Logo de {{ $match->homeClub->name }}">
                            @endif
                        </div>
                        <div class="ml-2">
                            <p class="text-xs md:text-base md:font-bold truncate">{{ $match->homeClub->name }}</p>
                        </div>
                    </div>
                    <div class="col-span-2 flex flex-row justify-center items-center">
                        @if ($match->live == 'attente')
                            <div class="flex items-center justify-center text-secondary">
                                <img src="{{ asset('images/vs-secondary.png') }}" alt="versus"
                                    class="h-12 lg:h-24 w-12 lg:w-24">
                            </div>
                        @elseif($match->live == 'reporte')
                            <p
                                class="bg-green-600 text-xs text-white rounded-md px-2 shadow-md border-b-2 border-r-2 border-white">
                                REPORTÉ</p>
                        @elseif($match->live != 'reporte' && $match->live != 'attente' && $match->live !=
                            'finDeMatch' && now()->between($match->date_match, $match->date_match->addMinutes(150)))
                            <div
                                class="relative uppercase inline-block text-primary font-bold bg-secondary px-2 rounded-sm text-xl">
                                <div
                                    class="animate-ping absolute -top-0.5 -right-0.5 bg-red-500 h-3 w-3 rounded-full z-10">
                                </div>
                                LIVE
                            </div>
                        @else
                            <div class="flex justify-center text-black">
                                <div class="bg-white rounded-sm mr-1 overflow-hidden">
                                    <p
                                        class="flex justify-center w-4 text-3xl px-4 font-bold {{ $match->home_score > $match->away_score ? 'bg-teal-400' : '' }}">
                                        {{ $match->home_score }}</p>
                                </div>
                                <div class="bg-white rounded-sm ml-1 z-10 overflow-hidden">
                                    <p
                                        class="flex justify-center w-4 text-3xl px-4 font-bold {{ $match->away_score > $match->home_score ? 'bg-teal-400' : '' }}">
                                        {{ $match->away_score }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="flex flex-col justify-center items-center col-span-5 overflow-hidden">
                        <div class="logo h-12 w-12 lg:h-16 lg:w-16 cursor-pointer">
                            @if ($match->awayClub->logo_path)
                                <img class="object-contain" src="{{ asset($match->awayClub->logo_path) }}"
                                    alt="Logo de {{ $match->awayClub->name }}">
                            @else
                                <img class="object-contain"
                                    src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->awayClub->numAffiliation }}.jpg"
                                    alt="Logo de {{ $match->awayClub->name }}">
                            @endif
                        </div>
                        <div class="ml-2">
                            <p class="text-xs md:text-base md:font-bold truncate">{{ $match->awayClub->name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
