@extends('layout')
@section('content')
    <section>
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
    </section>
    {{-- <section>
        @auth
            @if (Auth::user()->club)
                <a href="{{ route('clubs.show', Auth::user()->club) }}">
                    <div class="shadow-2xl py-10 md:py-4 w-full flex flex-col lg:flex-row justify-center items-center"
                        style="background:linear-gradient(-150deg, {{ Auth::user()->club->primary_color }}, {{ Auth::user()->club->secondary_color }})">
                        <div class="relative w-11/12 md:w-8/12 lg:w-4/12 rounded-lg bg-white">
                            <div class="flex justify-start items-center p-6">
                                <div class="logo h-16 w-16 border mx-2">
                                    @if (Auth::user()->club->logo_path)
                                        <img class="object-contain" src="{{ asset(Auth::user()->club->logo_path) }}"
                                            alt="Logo de {{ Auth::user()->club->name }}">
                                    @else
                                        <img class="object-contain"
                                            src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ Auth::user()->club->numAffiliation }}.jpg"
                                            alt="logo">
                                    @endif
                                </div>
                                <div>
                                    <h3 class="truncate text-xl">{{ Auth::user()->club->name }}</h3>
                                </div>
                            </div>
                            <div class="absolute bottom-2 right-2 flex items-end justify-end p-2">
                                <p class="border rounded-md px-1">mon club →</p>
                            </div>
                        </div>
                        <div>
                            
                        </div>
                    </div>
                </a>
            @else
                <div class="w-full flex flex-col sm:flex-row items-center justify-center mx-auto p-3 shadow-xl">
                    <div>
                        <h3 class="text-center text-2xl font-normal sm:mr-3">Tu es licencié dans un club ?</h3>
                        <p class="text-center text-xs">Ou tu supportes simplement un club...</p>
                    </div>
                    <a href="/clubs"><button class="btn btnSecondary h-14 w-auto">Choisis le <i
                                class="fas fa-arrow-right"></i></button></a>
                </div>
            @endif
        @else
            <div class="w-full flex flex-col sm:flex-row items-center justify-center mx-auto p-3 shadow-xl">
                <div>
                    <h3 class="text-center text-2xl font-normal sm:mr-3">Tu es licencié dans un club ?</h3>
                    <p class="text-center text-xs">Ou tu supportes simplement un club...</p>
                </div>
                <a href="/login"><button class="btn btnSecondary h-14 w-auto">Connecte toi <i
                            class="fas fa-arrow-right"></i></button></a>
            </div>
        @endauth
    </section> --}}
    <section>
        <div class="container mx-auto">
            <div class="flex flex-wrap justify-evenly mx-4 mb-10 text-center text-white">
                <div class="w-11/12 md:w-2/5 my-5 pb-5 bg-primary rounded-lg shadow-2xl">
                    <div class="rounded-lg h-48 overflow-hidden">
                        <img alt="tous les matchs" class="object-cover object-center h-full w-full"
                            src="{{ asset('images/ballon-feu.jpg') }}">
                    </div>
                    <h2 class="text-2xl font-medium mt-6 mb-3">Les matchs à venir</h2>
                    <p class="leading-relaxed text-base">Les matchs programmés sont à retrouver ici.</p>
                    <a href="/matches"><button class="btn btnSecondary">Je vais voir</button></a>
                </div>
                <div class="w-11/12 md:w-2/5 my-5 pb-5 bg-primary rounded-lg shadow-2xl">
                    <div class="rounded-lg h-48 overflow-hidden">
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
    </section>
    <section>
        <div class="text-gray-200 bg-gray-900 body-font shadow-2xl">
            <div class="container px-5 py-24 mx-auto">
                <div class="lg:w-2/3 flex flex-col sm:flex-row sm:items-center items-start mx-auto moveToLeft">
                    <h3 class="flex-grow sm:pr-16 text-xl font-medium text-white">Jete un oeil au match de démonstration
                        pour
                        voir comment ca fonctionne</h3>
                    <a href="matches/0"><button class="btn btnSecondary h-14 w-48">J'y vais</button></a>
                </div>
            </div>
        </div>
    </section>
    <section class="text-gray-600 body-font overflow-hidden" loading="lazy">
        <div class="container px-5 py-24 mx-auto">
            <div class="-my-8 divide-y-2 divide-gray-100">
                <div class="py-8 flex flex-wrap md:flex-nowrap">
                    <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
                        <span class="font-semibold title-font text-primary">BREAKING NEWS</span>
                        <span class="mt-1 text-gray-500 text-sm">01 juillet 2021</span>
                    </div>
                    <div class="md:flex-grow">
                        <h2 class="text-2xl font-medium text-gray-900 title-font mb-2">En mode application</h2>
                        <p class="leading-relaxed">Pour l'instant BTM, n'existe qu'en version web mais sa version mobile
                            arrivera très vite ! <br>
                            Cela prend du temps mais on va tout faire pour vous proposer une
                            expérience encore meilleure.
                        </p>
                    </div>
                </div>
                <div class="py-8 flex flex-wrap md:flex-nowrap">
                    <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
                        <span class="font-semibold title-font text-primary">BREAKING NEWS</span>
                        <span class="mt-1 text-gray-500 text-sm">01 mai 2020</span>
                    </div>
                    <div class="md:flex-grow">
                        <h2 class="text-2xl font-medium text-gray-900 title-font mb-2">Lancement du site</h2>
                        <p class="leading-relaxed">
                            Le site est enfin publié. Cela aura prit du temps et le site sera resté longtemps à l'état de
                            projet (merci Covid 😒)... <br>
                            On a décidé de le lancer et d'attendre vos retours qui nous seront
                            précieux.<br>
                            Nous en sommes qu'à la version bêta mais tout va s'accélérer une fois les matchs et compétitions
                            repartis !
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
        <div class="flex flex-col justify-center md:justify-around md:flex-row p-8">
            @if (count($user->favoristeams) > 0)
                <div class="w-full m-1">
                    <h3 class="text-center">
                        <i class="fas fa-heart text-red-700"></i>
                        Mes teams préférées
                        <i class="fas fa-heart text-red-700"></i>
                    </h3>
                    <div class="py-4">
                        @foreach ($user->favoristeams->shuffle() as $favoriteam)
                            <a href="{{ route('clubs.show', $favoriteam->club->id) }}">
                                <div class="flex flex-col mb-3">
                                    <div class="relative bg-primary rounded-lg overflow-hidden">
                                        <div class="mx-auto logo h-16 w-16 my-2">
                                            <img class="object-contain"
                                                src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $favoriteam->club->numAffiliation }}.jpg">
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
            @if (count($user->favorismatches) > 0)
                <div class="w-full m-1">
                    <div class="">
                        <h3 class="text-center"><i class="fas fa-star text-red-700"></i> Mes matchs favoris <i
                                class="fas fa-star text-red-700"></i></h3>
                    </div>
                    <div class="py-4">
                        @foreach ($user->favorismatches as $favorimatch)
                            @if ($favorimatch->match && $favorimatch->match->date_match > $today)
                                <a href="{{ route('matches.show', $favorimatch->match) }}">
                                    <div class="bg-primary text-white rounded-lg mb-2">
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
