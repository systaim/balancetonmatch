@extends('layout')
@section('content')
    <section>
        <div id="slideHome" class="hidden md:flex flex-col md:flex-row justify-between bg-primary overflow-hidden h-96 z-0">
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

    {{-- affichage mobile --}}
    <section class="md:hidden py-11">
        <a href="{{ route('competitions.index') }}">
            <div class="shadow-lg rounded-2xl w-5/6 p-4 bg-white relative overflow-hidden mx-auto">
                <img alt="competitions" src="{{ asset('images/ball-fire-water.png') }}"
                    class="absolute -right-16 -bottom-8 h-40 w-40 mb-4" />
                <div class="w-5/6">
                    <p class="text-gray-800 text-lg font-medium mb-2">
                        Compétitions
                    </p>
                    <p class="text-gray-400 text-xs">
                        Vous y trouverez les matchs à venir
                    </p>
                    <p class="text-primary text-lg font-medium flex items-center mt-2">
                        J'y vais
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" class="w-5 h-5 mx-2" viewBox="0 0 24 24">
                            <path d="M5 12h14M12 5l7 7-7 7"></path>
                        </svg>
                    </p>
                </div>
            </div>
        </a>
        <a href="/mon-espace/mes-favoris">
            <div class="shadow-lg rounded-2xl w-5/6 p-4 bg-white relative overflow-hidden mx-auto mt-6">
                <img alt="favoris" src="{{ asset('images/favoris-mobile.png') }}"
                    class="absolute -right-14 -bottom-8 h-32 w-32 mb-4" />
                <div class="w-5/6">
                    <p class="text-gray-800 text-lg font-medium mb-2">
                        Mes favoris
                    </p>
                    <p class="text-gray-400 text-xs">
                        Vos matchs et équipes en favoris
                    </p>
                    <p class="text-primary text-lg font-medium flex items-center mt-2">
                        J'y vais
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" class="w-5 h-5 mx-2" viewBox="0 0 24 24">
                            <path d="M5 12h14M12 5l7 7-7 7"></path>
                        </svg>
                    </p>
                </div>
            </div>
        </a>
        <a href="/live">
            <div class="shadow-lg rounded-2xl w-5/6 p-4 bg-white relative overflow-hidden mx-auto mt-6">
                <img alt="live" src="{{ asset('images/micro.png') }}"
                    class="absolute -right-24 -bottom-16 h-48 w-48 mb-4" />
                <div class="w-5/6">
                    <p class="text-gray-800 text-lg font-medium mb-2">
                        Les lives
                    </p>
                    @if (count($liveMatches) == 0)
                        <p class="text-gray-400 text-xs">Pas de matchs en ce moment</p>
                    @else
                        <div class="flex">
                            <p
                                class="mr-1 text-xs flex items-center justify-center rounded-full text-primary h-5 w-5 bg-secondary">
                                {{ count($liveMatches) }}
                            </p>
                            <p class="text-gray-400 text-xs">
                                {{ count($liveMatches) == 1 ? 'match' : 'matchs' }} en cours
                            </p>
                        </div>

                    @endif
                    <p class="text-primary text-lg font-medium flex items-center mt-2">
                        J'y vais
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" class="w-5 h-5 mx-2" viewBox="0 0 24 24">
                            <path d="M5 12h14M12 5l7 7-7 7"></path>
                        </svg>
                    </p>
                </div>
            </div>
        </a>
    </section>

    {{-- affichage desktop --}}
    <section class="hidden md:block">
        <div class="container mx-auto">
            <div class="flex flex-wrap justify-evenly mx-4 mb-10 text-center text-white">
                <div class="relative w-11/12 md:w-2/5 my-5 bg-primary rounded-lg shadow-2xl">
                    <a href="{{ route('competitions.index') }}">
                        <div class="rounded-lg h-48 overflow-hidden">
                            <img alt="tous les matchs" class="object-cover object-center h-full w-full"
                                src="{{ asset('images/ballon-feu.jpg') }}">
                        </div>
                        <h2 class="text-2xl font-medium mt-6 mb-3">Les matchs à venir</h2>
                        {{-- <p class="leading-relaxed text-base">Par compétition</p> --}}
                        <div class="flex justify-end">
                            <button class="btn btnSecondary">
                                <p class="flex items-center">
                                    J'y vais
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                                    </svg>
                                </p>
                            </button>
                        </div>
                    </a>
                </div>
                <div class="relative w-11/12 md:w-2/5 my-5 bg-primary rounded-lg shadow-2xl">
                    <a href="/mon-espace/mes-favoris">
                        <div class="rounded-lg h-48 overflow-hidden">
                            <img alt="mes favoris" class="object-cover object-center h-full w-full"
                                src="{{ asset('images/fav.jpg') }}">
                        </div>
                        <h2 class="text-2xl font-medium mt-6 mb-3">Mes favoris</h2>
                        {{-- <p class="leading-relaxed text-base">Les matchs et équipes mis en favoris</p> --}}
                        <div class="flex justify-end">
                            <button class="btn btnSecondary">
                                <p class="flex items-center">
                                    J'y vais
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                                    </svg>
                                </p>
                            </button>
                        </div>
                    </a>
                </div>
                <div class="relative w-11/12 md:w-2/5 my-5 bg-primary rounded-lg shadow-2xl">
                    <a href="/live">
                        <div class="rounded-lg h-48 overflow-hidden">
                            <img alt="les matchs en live" class="object-cover object-center h-full w-full"
                                src="{{ asset('images/on-air.jpg') }}">
                        </div>
                        <h2 class="text-2xl font-medium mt-6">Les matchs en Live</h2>
                        @if (count($liveMatches) == 0)
                            <p class="leading-relaxed text-base">Pas de matchs en ce moment</p>
                        @else
                            <p class="leading-relaxed text-base">En ce moment <span
                                    class="bg-secondary text-primary py-1 px-2 rounded-lg">{{ count($liveMatches) }}</span>
                                {{ count($liveMatches) == 1 ? 'match' : 'matchs' }} en cours</p>
                        @endif
                        <div class="flex justify-end">
                            <button class="btn btnSecondary">
                                <p class="flex items-center">
                                    J'y vais
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                                    </svg>
                                </p>
                            </button>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="relative">
        <div class="text-gray-200 bg-gray-900 body-font shadow-2xl">
            <div class="container px-5 py-10 lg:py-20 mx-auto moveToLeft">
                <div
                    class="lg:w-2/3 flex flex-col lg:flex-row items-start lg:items-center justify-center lg:justify-start mx-auto">
                    <h3 class="text-sm lg:text-xl font-medium text-white ml-2">
                        Un match en démo
                    </h3>
                    <a href="matches/0" class="z-30">
                        <button class="btn btnSecondary flex items-center text-sm lg:text-base">
                            J'y vais
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <div class="absolute -top-18 lg:-top-20 right-0  lg:right-48">
            <img src="{{ asset('images/demo2.png') }}" alt="demo" class="h-72 lg:h-96">
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

@endsection
