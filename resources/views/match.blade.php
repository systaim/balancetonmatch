<div class="relative" x-data="{ open: false }">
    @if ($match->date_match > now())
        <div class="absolute h-full left-2 sm:left-4 z-40 text-center flex justify-center items-center font-bold">
            @livewire('favori-match', ['user' => Auth::user(), 'match' => $match])
        </div>
    @endif
    <div class="relative my-2 p-1 cursor-pointer mx-1 lg:mx-0">
        @auth
            <div class="w-6 h-6 absolute top-2 right-1 flex justify-center items-center rounded-full text-primary border shadow-lg z-40"
                @click="open= true">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9h16.5m-16.5 6.75h16.5" />
                </svg>

                <div class="absolute top-0 right-0 w-32 h-auto py-4 pl-6 bg-secondary shadow-xl rounded-lg z-50 text-sm"
                    x-show="open" @click.away="open = false" style="display: none">
                    <a class="w-full" href="{{ route('matches.edit', ['match' => $match]) }}">modifier</a>
                    @if ((Auth::user() && $match->user_id == Auth::user()->id && $match->live == 'attente') ||
                        Auth::user()->role == 'super-admin' ||
                        Auth::user()->role == 'admin')
                        <a class="w-full" href="{{ route('matches.destroy', $match) }}"
                            onclick="event.preventDefault();
                            document.getElementById('delete-match-{{ $match->id }}').submit();">
                            Effacer
                        </a>
                    @endif
                </div>
                <form id="delete-match-{{ $match->id }}" action="{{ route('matches.destroy', $match) }}" method="POST">
                    @method('DELETE')
                    @csrf
                </form>
            </div>
        @endauth
        <a href="{{ route('matches.show', [$match, Str::slug($match->slug, '-')]) }}">
            <div>
                {{-- <div class="text-sm text-center flex justify-center mb-2">
                    <p class="px-4">{{ $match->date_match->formatLocalized('%d/%m/%y') }}</p>
                    <p class="px-4">{{ $match->date_match->formatLocalized('%H:%M') }}</p>
                </div> --}}
                <div class="grid grid-cols-12">
                    <div class="flex flex-col justify-center items-center col-span-5 overflow-hidden">
                        <div class="logo h-6 w-6 lg:h-10 lg:w-10 cursor-pointer">
                            <img class="object-contain" src="{{ asset($match->homeClub->logo) }}"
                                alt="Logo de {{ $match->homeClub->name }}">
                        </div>
                        <div class="ml-2">
                            <p class="text-xs md:font-bold truncate">{{ $match->homeClub->initial }}</p>
                        </div>
                    </div>
                    <div class="col-span-2 flex flex-row justify-center items-center">
                        @if ($match->live == 'attente' && !isset($match->home_score) && !isset($match->away_score))
                            {{-- <div class="flex items-center justify-center text-secondary">
                                <img src="{{ asset('images/vs-primary.jpg') }}" alt="versus"
                                    class="h-6 lg:h-12 w-6 lg:w-12">
                            </div> --}}
                            <div class="flex flex-col items-center font-bold text-xs">
                                <p class="px-4">{{ $match->date_match->formatLocalized('%d/%m/%y') }}</p>
                                <p class="px-4">{{ $match->date_match->formatLocalized('%H:%M') }}</p>
                            </div>
                        @elseif($match->live != 'reporte' &&
                            $match->live != 'attente' &&
                            $match->live != 'finDeMatch' &&
                            now()->between($match->date_match, $match->date_match->addMinutes(240)))
                            <div
                                class="relative uppercase inline-block text-primary font-bold bg-secondary px-2 rounded-sm text-xl">
                                <div
                                    class="animate-ping absolute -top-0.5 -right-0.5 bg-red-500 h-3 w-3 rounded-full z-10">
                                </div>
                                LIVE
                            </div>
                        @else
                            <div class="flex justify-center text-black">
                                <div class="rounded-sm mr-1 overflow-hidden">
                                    <p
                                        class="flex justify-center w-4 text-xl px-4 font-bold rounded-sm {{ $match->home_score > $match->away_score ? 'bg-secondary' : '' }}">
                                        {{ $match->home_score }}</p>
                                </div>
                                <div class="rounded-sm ml-1 z-10 overflow-hidden">
                                    <p
                                        class="flex justify-center w-4 text-xl px-4 font-bold rounded-sm {{ $match->away_score > $match->home_score ? 'bg-secondary' : '' }}">
                                        {{ $match->away_score }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="flex flex-col justify-center items-center col-span-5 overflow-hidden">
                        <div class="logo h-6 w-6 lg:h-10 lg:w-10 cursor-pointer">
                            <img class="object-contain" src="{{ asset($match->awayClub->logo) }}"
                                alt="Logo de {{ $match->awayClub->name }}">
                        </div>
                        <div class="ml-2">
                            <p class="text-xs md:font-bold truncate">{{ $match->awayClub->initial }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
