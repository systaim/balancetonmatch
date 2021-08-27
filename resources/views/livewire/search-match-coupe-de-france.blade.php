<div class="relative flex flex-col md:w-8/12 m-auto my-8">
    <div>
        <input wire:model="search" class="inputForm w-full" type="text" name="search"
            placeholder="Nom du club, de la ville ou code postal">
        <i class="absolute text-xl mt-3 mr-3 top-0 right-0 text-primary fas fa-search"></i>
    </div>
    <div class="absolute w-full top-13 h-auto z-50">
        @foreach ($matchs as $match)

            <div class="relative text-primary bg-white px-2 py-2 hover:bg-blue-200">
                <div class="relative flex justify-center items-center z-50">
                    <div class="absolute top-2 left-2">
                        <livewire:favori-match :match="$match" :user="Auth::user()" :key="$match->id"/>
                    </div>
                    <div>
                        <p class="text-xs text-center">{{ $match->competition->name }}</p>
                        <p class="text-center text-sm">{{ $match->date_match->formatLocalized('%d/%m/%y') }}
                            {{ $match->date_match->formatLocalized('%H:%M') }}</p>
                    </div>
                </div>
                <a href="{{ route('matches.show', $match) }}">
                    <div class="grid grid-cols-3 w-full">
                        <div class="col-span-1 flex flex-col items-center">
                            <div class="logo h-12 w-12 cursor-pointer m-4 border-2 border-primary">
                                <div class="flex-grow-0 logo">
                                    @if ($match->homeClub->logo_path)
                                        <img class="object-contain" src="{{ asset($match->homeClub->logo_path) }}"
                                            alt="Logo de {{ $match->homeClub->name }}">
                                    @else
                                        <img class="object-contain"
                                            src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->homeClub->numAffiliation }}.jpg"
                                            alt="logo">
                                    @endif
                                </div>
                            </div>
                            <p class="text-center">{{ $match->homeClub->name }}</p>
                        </div>
                        <div class="flex items-center justify-center text-primary">
                            <img src="{{ asset('images/vs-primary.png') }}" alt="versus" class="h-12 w-12">
                        </div>
                        <div class="col-span-1 flex flex-col items-center">
                            <div class="logo h-12 w-12 cursor-pointer m-4 border-2 border-primary">
                                <div class="flex-grow-0 logo h-12 w-12">
                                    @if ($match->awayClub->logo_path)
                                        <img class="object-contain" src="{{ asset($match->awayClub->logo_path) }}"
                                            alt="Logo de {{ $match->awayClub->name }}">
                                    @else
                                        <img class="object-contain"
                                            src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->awayClub->numAffiliation }}.jpg"
                                            alt="logo">
                                    @endif
                                </div>
                            </div>
                            <p class="text-center">{{ $match->awayClub->name }}</p>
                        </div>
                    </div>
                </a>
            </div>

        @endforeach
        @if (count($matchs) == 0 && strlen($search) >= 3)
            <div class="bg-white py-4">
                <p class="text-center">Tu n'as pas trouvé ce que tu voulais ?</p>
                <a class="flex justify-center" href="{{ route('matches.create') }}">
                    <button class="btn btnSecondary">Crée un match</button>
                </a>
            </div>
        @endif
    </div>
</div>
