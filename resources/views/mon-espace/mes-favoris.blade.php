@extends('layout')
@section('content')
<div class="relative w-full py-10 px-4 bg-primary text-white flex flex-col lg:flex-col-reverse justify-center items-center mb-6">
    <h2 class="text-4xl lg:text-6xl">Mes Favoris</h2>
</div>
    @auth
        <div class="flex flex-col justify-center md:justify-around md:flex-row p-8">
            @if (count(Auth::user()->favorismatches) > 0)
                <div class="w-full m-1">
                    <div class="___class_+?62___">
                        <h3 class="text-center"><i class="fas fa-star text-red-700"></i> Mes matchs favoris <i
                                class="fas fa-star text-red-700"></i></h3>
                    </div>
                    <div class="py-4">
                        @foreach (Auth::user()->favorismatches as $match)
                            @if ($match->match && $match->match->date_match > now())

                                <div class="bg-primary text-white rounded-lg mb-2 py-2 overflow-hidden">
                                    <div class="relative text-center flex justify-center items-center pb-2">
                                        <div class="absolute left-1 top-0">
                                            <livewire:favori-match :match="$match->match" :user="Auth::user()"
                                            :key="time().$match->match->id" />
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
                                                    @if ($match->match->homeClub->logo_path)
                                                        <img class="object-contain"
                                                            src="{{ asset($match->match->homeClub->logo_path) }}"
                                                            alt="Logo de {{ $match->match->homeClub->name }}">
                                                    @else
                                                        <img class="object-contain"
                                                            src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->match->homeClub->numAffiliation }}.jpg"
                                                            alt="Logo de {{ $match->match->homeClub->name }}">
                                                    @endif
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
                                <div class="flex flex-col mb-3">
                                    <div class="relative bg-primary rounded-lg overflow-hidden">
                                        <div class="mx-auto logo h-16 w-16 my-2">
                                            @if ($favoriteam->club->logo_path)
                                                <img class="object-contain" src="{{ asset($favoriteam->club->logo_path) }}"
                                                    alt="Logo de {{ $favoriteam->club->name }}">
                                            @else
                                                <img class="object-contain"
                                                    src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $favoriteam->club->numAffiliation }}.jpg"
                                                    alt="Logo de {{ $favoriteam->club->name }}">
                                            @endif
                                        </div>
                                        <div class=" py-2 w-full text-secondary overflow-hidden ml-2 z-10">
                                            <p class="truncate font-bold text-center">{{ $favoriteam->club->name }}</p>
                                        </div>
                                        <div class="absolute -bottom-7 -right-7 transform -rotate-45 z-0">
                                            <div class="h-2 w-36 mb-1"
                                                style="background-color: {{ $favoriteam->club->primary_color }};"></div>
                                            <div class="h-2 w-36"
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
