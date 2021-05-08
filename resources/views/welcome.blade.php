@extends('layout')
@section('content')

    <div id="slideHome" class="flex flex-col md:flex-row justify-between bg-primary overflow-hidden h-96 z-0">
        <div class="h-6/12 sm:h-8/12 md:h-auto md:w-6/12 img-bg-blend-home">
        </div>
        <div id="welcome" class="h-auto text-white py-4 md:w-6/12 px-12 xl:w-4/12 m-auto text-center">
            <div class="flex items-center justify-center">
                <hr class="w-10 border border-secondary">
                <h2 class="text-xl md:text-3xl my-2 mx-6 font-medium">Bienvenue</h2>
                <hr class="w-10 border border-secondary">
            </div>
            <p class="text-sm md:text-base text-justify">BalanceTonMatch.com a pour but de rassembler les passionnés du
                ballon rond AMATEUR.</p>
            <p class="text-sm md:text-base text-justify">Vous pourrez suivre les matchs en <span
                    class="uppercase text-primary font-bold bg-secondary px-2 rounded-sm">live</span> soit en tant que
                commentateur soit en tant que spectateur</p>
        </div>
    </div>
    <div id="wrong" class="shadow-xl">
        <div class="container mx-auto flex justify-around px-5 py-6 md:flex-row flex-col items-center">
            <div class="lg:flex-grow md:w-1/2 px-8 flex flex-col md:items-start md:text-left items-center text-center">
                <h2 class="text-3xl mb-4 font-medium">Le sport amateur va reprendre !</h2>
                <p class="mb-4">La saison 2021-2022 est déjà dans toutes les têtes.</p>
                <p class="mb-8 text-justify">
                    Les mutations commencent déjà à faire parler 😎 <br>
                    Et l'organisation des matchs amicaux pour préparer cette saison également. <br>
                    Ne faites pas les timides, partagez vos matchs en live et profitez des matchs amicaux de cette inter-saison pour vous exercer.
                </p>
            </div>
            <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6 mb-10 md:mb-0">
                <img class="object-cover object-center rounded" alt="hero" src="{{ asset('images/reprise.jpg') }}">
            </div>
        </div>
    </div>
    <div class="text-gray-200 bg-gray-900 body-font shadow-2xl">
        <div class="container px-5 py-24 mx-auto">
            <div class="lg:w-2/3 flex flex-col sm:flex-row sm:items-center items-start mx-auto moveToLeft">
                <h3 class="flex-grow sm:pr-16 text-xl font-medium text-white">Jete un oeil au match de démonstration pour
                    voir comment ca fonctionne</h3>
                <a href="matches/0"><button class="btn btnSecondary h-14 w-48">J'y vais</button></a>
            </div>
        </div>
    </div>
    <div class="container px-5 mx-auto">
        <div class="flex flex-wrap justify-evenly mx-4 mb-10 text-center text-white moveToTop opacity-0">
            <div class="lg:w-2/5 my-5 pb-10 bg-primary rounded-lg shadow-2xl">
                <div class="rounded-lg h-64 overflow-hidden">
                    <img alt="tous les matchs" class="object-cover object-center h-full w-full"
                        src="{{ asset('images/ballon-feu.jpg') }}">
                </div>
                <h2 class="text-2xl font-medium mt-6 mb-3">Les matchs à venir</h2>
                <p class="leading-relaxed text-base">Les matchs programmés sont à retrouvés ici.</p>
                <a href="/matches"><button class="btn btnSecondary">Je vais voir</button></a>
            </div>
            <div class="lg:w-2/5 my-5 pb-10 bg-primary rounded-lg shadow-2xl moveToTop opacity-0">
                <div class="rounded-lg h-64 overflow-hidden">
                    <img alt="les matchs en live" class="object-cover object-center h-full w-full"
                        src="{{ asset('images/on-air.jpg') }}">
                </div>
                <h2 class="text-2xl font-medium mt-6 mb-3">Les matchs en Live</h2>
                <p class="leading-relaxed text-base">En ce moment <span
                        class="bg-secondary text-primary py-1 px-2 rounded-lg">{{ count($liveMatches) }}</span>
                    {{ count($liveMatches) <= 1 ? 'match' : 'matchs' }} en cours</p>
                <a href="/live"><button class="btn btnSecondary">Je vais voir</button></a>
            </div>
        </div>
    </div>

    {{-- <div class="py-6">
        <div class="flex justify-center">
            <h3 class="p-2 text-primary text-2xl">La saison 2020/2021 c'est : </h3>
        </div>
        <div class="flex flex-wrap justify-center">
            <div class="flex justify-between">
                <div
                    class="flex flex-col items-center justify-center text-primary w-20 h-20 md:w-28 md:h-28 lg:w-40 lg:h-40 md:bg-primary md:text-white my-2 mx-1 rounded-lg shadow-lg">
                    <p class="compteur text-xl lg:text-5xl font-bold">{{ count($matches) + 300 }}</p>
                    <p class="text-xs lg:text-base">{{ count($matches) <= 1 ? 'matchs' : 'matchs' }}</p>
                </div>
                <div
                    class="flex flex-col items-center justify-center text-primary w-20 h-20 md:w-28 md:h-28 lg:w-40 lg:h-40 md:bg-primary md:text-white my-2 mx-1 rounded-lg shadow-lg">
                    <p class="compteur text-xl lg:text-5xl font-bold">{{ count($clubs) }}</p>
                    <p class="text-xs lg:text-base">clubs</p>
                </div>
                <div
                    class="flex flex-col items-center justify-center text-primary w-20 h-20 md:w-28 md:h-28 lg:w-40 lg:h-40 md:bg-primary md:text-white my-2 mx-1 rounded-lg shadow-lg">
                    <p class="compteur text-xl lg:text-5xl font-bold">{{ count($players) + count($staffs) + 2450 }}</p>
                    <p class="text-xs lg:text-base">licenciés</p>
                </div>
            </div>
            <div class="flex justify-between">
                <div
                    class="flex flex-col items-center justify-center text-primary w-20 h-20 md:w-28 md:h-28 lg:w-40 lg:h-40 md:bg-primary md:text-white my-2 mx-1 rounded-lg shadow-lg">
                    <p class="compteur text-xl lg:text-5xl font-bold">{{ count($goals) + 580 }}</p>
                    <p class="text-xs lg:text-base">{{ count($goals) <= 1 ? 'but' : 'buts' }}</p>
                </div>
                <div
                    class="flex flex-col items-center justify-center text-primary w-20 h-20 md:w-28 md:h-28 lg:w-40 lg:h-40 md:bg-primary md:text-white my-2 mx-1 rounded-lg shadow-lg">
                    <p class="compteur text-xl lg:text-5xl font-bold">{{ count($commentators) + 90 }}</p>
                    <p class="text-xxs lg:text-base">{{ count($commentators) <= 1 ? 'commentateurs' : 'commentateurs' }}
                    </p>
                </div>
                <div
                    class="flex flex-col items-center justify-center text-primary w-20 h-20 md:w-28 md:h-28 lg:w-40 lg:h-40 md:bg-primary md:text-white my-2 mx-1 rounded-lg shadow-lg">
                    <p class="compteur text-xl lg:text-5xl font-bold">{{ count($yellowCards) + count($redCards) + 359 }}
                    </p>
                    <p class="text-xs lg:text-base">
                        {{ count($yellowCards) + count($redCards) <= 1 ? 'cartons' : 'cartons' }}</p>
                </div>
            </div>
        </div>
    </div> --}}

    @auth
        <div class="flex flex-col w-full lg:flex-row justify-around py-8">

            @if (count($user->favoristeams) > 0)
                <div class="lg:w-5/12">
                    <div>
                        <h3><i class="fas fa-heart text-red-700"></i> Mes teams préférées <i
                                class="fas fa-heart text-red-700"></i></h3>
                    </div>
                    <div class="py-4">
                        @foreach ($user->favoristeams->shuffle() as $favoriteam)
                            <a href="{{ route('clubs.show', $favoriteam->club->id) }}">
                                <div class="flex flex-col mb-3">
                                    <div class="relative flex flex-row items-center bg-primary rounded-lg overflow-hidden">
                                        <div class="w-16 m-2 z-10">
                                            <div class="logo h-12 w-12">
                                                <img class="object-contain"
                                                    src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $favoriteam->club->numAffiliation }}.jpg">
                                            </div>
                                        </div>
                                        <div class=" py-2 w-full text-secondary overflow-hidden ml-2 z-10">
                                            <p class="truncate font-bold">{{ $favoriteam->club->name }}</p>
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

            @if (count($user->favorismatches) > 0)
                <div class="lg:w-5/12">
                    <div class="">
                        <h3 class=""><i class="fas fa-star text-red-700"></i> Mes matchs favoris <i
                                class="fas fa-star text-red-700"></i></h3>
                    </div>
                    <div class="py-4">
                        @foreach ($user->favorismatches as $favorimatch)
                            @if ($favorimatch->match->date_match > $today)
                                <a href="{{ route('matches.show', $favorimatch->match) }}">
                                    <div class="p-2 bg-primary text-white rounded-lg m-2">
                                        <div class="text-center flex justify-center font-bold">
                                            <p class="px-4 bg-primary text-secondary rounded-tl-md">
                                                {{ $favorimatch->match->date_match->formatLocalized('%d/%m/%y') }}</p>
                                            <p class="px-4 bg-primary text-secondary rounded-tr-md">
                                                {{ $favorimatch->match->date_match->formatLocalized('%H:%M') }}</p>
                                        </div>
                                        <div class="grid grid-cols-3">
                                            <div class="flex flex-col items-center justify-center overflow-hidden">
                                                <div class="logo h-14 w-14 cursor-pointer">
                                                    <img class="object-contain"
                                                        src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $favorimatch->match->homeClub->numAffiliation }}.jpg"
                                                        alt="logo">
                                                </div>
                                                <div class="ml-2">
                                                    <p class="text-xs truncate">{{ $favorimatch->match->homeClub->name }}</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-center text-secondary">
                                                <p class="text-3xl p-2 font-bold">VS</p>
                                            </div>
                                            <div class="flex flex-col items-center justify-center overflow-hidden">
                                                <div class="logo h-14 w-14 cursor-pointer">
                                                    <img class="object-contain"
                                                        src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $favorimatch->match->awayClub->numAffiliation }}.jpg"
                                                        alt="logo">
                                                </div>
                                                <div class="ml-2">
                                                    <p class="text-xs truncate">{{ $favorimatch->match->awayClub->name }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    @endauth

@endsection
