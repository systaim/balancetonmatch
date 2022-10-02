@extends('layout')
@section('content')
    <div class="relative w-full py-1 bg-white flex justify-center items-center mb-6">
        <img alt="favoris" src="{{ asset('images/favoris-mobile.png') }}" class="h-36">
        <h2 class="-ml-20 text-3xl lg:text-6xl text-primary py-1 px-3 rounded-md">Mes favoris</h2>
    </div>
    @auth
        <div class="flex flex-col justify-center md:justify-around md:flex-row p-8">
            @if (count(Auth::user()->favorismatches) > 0)
                <div class="w-full m-1">
                    <div>
                        <h3 class="text-center"><i class="fas fa-star text-red-700"></i> Mes matchs favoris <i
                                class="fas fa-star text-red-700"></i></h3>
                    </div>
                    <div class="py-4">
                        @foreach (Auth::user()->favorismatches as $match)
                            @if ($match->match && $match->match->date_match > now()->subHours(12))
                                <div class="rounded-lg mb-2 py-2 overflow-hidden shadow-lg">
                                    <div class="relative text-center flex justify-center items-center pb-2">
                                        <div class="absolute left-1 top-0">
                                            <livewire:favori-match :match="$match->match" :user="Auth::user()" :key="time() . $match->match->id" />
                                        </div>
                                        <p class="px-4">
                                            {{ $match->match->date_match->formatLocalized('%d/%m/%y') }}</p>
                                        <p class="px-4">
                                            {{ $match->match->date_match->formatLocalized('%H:%M') }}</p>
                                    </div>
                                    <a href="{{ route('matches.show', $match->match) }}">
                                        <div class="grid grid-cols-3">
                                            <div class="flex flex-col items-center justify-center overflow-hidden">
                                                <div class="logo h-14 w-14 cursor-pointer">
                                                    <img class="object-contain" src="{{ asset($match->match->homeClub->logo) }}"
                                                        alt="Logo de {{ $match->match->homeClub->name }}">
                                                </div>
                                                <div class="ml-2">
                                                    <p class="text-xs truncate">{{ $match->match->homeClub->name }}</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-center text-secondary">
                                                <p class="text-3xl p-2 font-bold">VS</p>
                                            </div>
                                            <div class="flex flex-col items-center justify-center overflow-hidden">
                                                <div class="logo h-14 w-14 cursor-pointer">
                                                    <img class="object-contain"
                                                        src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->match->awayClub->numAffiliation }}.jpg"
                                                        alt="logo">
                                                </div>
                                                <div class="ml-2">
                                                    <p class="text-xs truncate">{{ $match->match->awayClub->name }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
            @if (count(Auth::user()->favoristeams) > 0)
                <div class="w-full m-1">
                    <h3 class="text-center">
                        <i class="fas fa-heart text-red-700"></i>
                        Mes teams préférées
                        <i class="fas fa-heart text-red-700"></i>
                    </h3>
                    <div class="py-4">
                        @foreach (Auth::user()->favoristeams->shuffle() as $favoriteam)
                            <a href="{{ route('clubs.show', $favoriteam->club->id) }}">
                                <div class="flex flex-col mb-1 w-full border rounded-md shadow-md">
                                    <div class="relative flex flex-row items-center overflow-hidden rounded-lg">
                                        <div class="w-12 m-2 z-10">
                                            <div class="logo h-8 w-8">
                                                <img class="object-contain" src="{{ asset($favoriteam->club->logo) }}"
                                                    alt="Logo de {{ $favoriteam->club->name }}">
                                            </div>
                                        </div>
                                        <div class="py-1 w-full overflow-hidden ml-2 z-10">
                                            <p class="truncate font-bold">{{ $favoriteam->club->name }}</p>
                                            <p>{{ $favoriteam->club->zip_code }} {{ $favoriteam->club->city }}</p>
                                        </div>
                                        <div class="absolute -bottom-7 -right-7 transform -rotate-45 z-0">
                                            <div class="h-2 w-36 mb-1 border shadow"
                                                style="background-color: {{ $favoriteam->club->primary_color }};"></div>
                                            <div class="h-2 w-36 border shadow"
                                                style="background-color: {{ $favoriteam->club->secondary_color }};"></div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    @endauth
@endsection
