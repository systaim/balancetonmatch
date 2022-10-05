<div>
    <div id="slideHome" class="relative bg-gray-800 p-4">
        <div class="absolute inset-0">
            {{-- <img class="w-full h-full object-cover" src="{{ asset('images/home-preview.jpg') }}" alt="" loading="lazy"> --}}
            <video autoplay muted loop playsinline id="myVideo" class="w-full h-full object-cover">
                <source src="{{ asset('videos/bg-search.mp4') }}" type="video/mp4">
            </video>
            <div class="absolute inset-0 bg-gray-800 mix-blend-multiply" aria-hidden="true"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:py-32 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">Bienvenue</h1>
            <p class="mt-6 text-sm lg:text-xl text-indigo-100 max-w-3xl">BalanceTonMatch.com a pour but de rassembler
                les
                passionnés du
                ballon rond AMATEUR. Vous pourrez suivre les matchs en <span
                    class="uppercase text-primary font-bold bg-secondary px-2 rounded-sm">live</span> soit en tant que
                commentateur soit en tant que spectateur</p>
        </div>
        <div class="relative w-full">
            <div class="flex flex-wrap justify-around">
                <div class="flex justify-between">
                    {{-- <div class="flex flex-col items-center justify-center text-white my-2 mx-1 p-4">
                        <p class="compteur text-xl">{{ count($matches) }}</p>
                        <p class="text-xs lg:text-base">{{ count($matches) <= 1 ? 'matchs' : 'matchs' }}</p>
                    </div>
                    <div class="flex flex-col items-center justify-center text-white my-2 mx-1 p-4">
                        <p class="compteur text-xl">{{ count($clubs) }}</p>
                        <p class="text-xs lg:text-base">clubs</p>
                    </div> --}}
                    {{-- <div
                        class="flex flex-col items-center justify-center text-white my-2 mx-1 p-4">
                        <p class="compteur text-xl">{{ count($players) + count($staffs) }}</p>
                        <p class="text-xs lg:text-base">joueurs</p>
                    </div> --}}
                </div>
                {{-- <div class="flex justify-between">
                    <div
                        class="flex flex-col items-center justify-center text-white my-2 mx-1 p-4">
                        <p class="compteur text-xl">{{ count($goals) }}</p>
                        <p class="text-xs lg:text-base">{{ count($goals) <= 1 ? 'but' : 'buts' }}</p>
                    </div>
                    <div
                        class="flex flex-col items-center justify-center text-white my-2 mx-1 p-4">
                        <p class="compteur text-xl">{{ count($all_commentators) }}</p>
                        <p class="text-xxs lg:text-base">
                            {{ count($commentators) <= 1 ? 'commentateurs' : 'commentateurs' }}
                        </p>
                    </div>
                    <div
                        class="flex flex-col items-center justify-center text-white my-2 mx-1 p-4">
                        <p class="compteur text-xl">{{ count($yellowCards) + count($redCards) }}
                        </p>
                        <p class="text-xs lg:text-base">
                            {{ count($yellowCards) + count($redCards) <= 1 ? 'cartons' : 'cartons' }}</p>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="p-3 relative overflow-hidden h-48"
        style='background-image: url("{{ asset('images/terrain2.png') }}"); background-size:cover'>
        <div class="z-10">
            <h3 class="text-center">Rechercher un club</h3>
            <form action="/clubs" method="GET">
                <div class="flex flex-col justify-center items-center">
                    <input type="search" name="search" id="search"
                        class="border rounded-md shadow-lg w-10/12 lg:w-6/12">
                    <button type="submit" class="btn btnPrimary">Va chercher</button>
                </div>
            </form>
        </div>
    </div>
    {{-- <div class="bg-secondary text-primary">
        <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between flex-wrap">
                <div class="flex justify-center items-center w-full">
                    <span class="flex p-2 rounded-lg bg-primary">
                        <!-- Heroicon name: outline/speakerphone -->
                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                        </svg>
                    </span>
                    <p class="ml-3 font-medium">
                        Créez vos matchs amicaux pour pouvoir les commenter en direct
                    </p>
                </div>
            </div>
            <div class="flex justify-center">
                <a href="{{ route('matches.create') }}">
                    <button class="btn btnPrimary" type=button>Je crée un match</button>
                </a>
            </div>
        </div>
    </div> --}}
    {{-- <div class="text-center">
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7237777700901740"
                crossorigin="anonymous"></script>
        <!-- top banniere -->
        <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-7237777700901740" data-ad-slot="1803015183"
            data-ad-format="auto" data-full-width-responsive="true"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div> --}}
    <div class="py-11 flex flex-col-reverse md:flex-row items-center">
        @livewire('home.load-activities')
        <div class="flex-1 w-full">
            <a href="{{ route('competitions.index') }}">
                <div class="shadow-white-xl rounded-lg w-5/6 p-4 bg-primary relative overflow-hidden mx-auto">
                    <img alt="competitions" src="{{ asset('images/ball-fire-water.png') }}" loading="lazy"
                        class="absolute -right-16 -bottom-8 h-40 w-40 mb-4" />
                    <div class="w-5/6">
                        <p class="text-gray-200 text-lg font-medium mb-2">
                            Compétitions
                        </p>
                        <p class="text-gray-300 text-xs">
                            Vous y trouverez les matchs à venir
                        </p>
                        <p class="text-white text-lg font-medium flex items-center mt-2">
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
                <div class="shadow-white-xl rounded-lg w-5/6 p-4 bg-primary relative overflow-hidden mx-auto mt-6">
                    <img alt="favoris" src="{{ asset('images/favoris-mobile.png') }}"
                        class="absolute -right-14 -bottom-8 h-32 w-32 mb-4" />
                    <div class="w-5/6">
                        <p class="text-gray-200 text-lg font-medium mb-2">
                            Mes favoris
                        </p>
                        <p class="text-gray-300 text-xs">
                            Vos matchs et équipes en favoris
                        </p>
                        <p class="text-white text-lg font-medium flex items-center mt-2">
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
                <div class="shadow-white-xl rounded-lg w-5/6 p-4 bg-primary relative overflow-hidden mx-auto mt-6">
                    <img alt="live" src="{{ asset('images/micro.png') }}" loading="lazy"
                        class="absolute -right-24 -bottom-16 h-48 w-48 mb-4" />
                    <div class="w-5/6">
                        <p class="text-gray-200 text-lg font-medium mb-2">
                            Les lives du jour
                        </p>
                        @if (count($liveMatches) == 0)
                            <p class="text-gray-300 text-xs">Pas de matchs en ce moment</p>
                        @else
                            <div class="flex items-center">
                                <p
                                    class="mr-1 text-xs flex items-center justify-center rounded-full text-primary h-5 w-5 bg-secondary">
                                    {{ count($liveMatches) }}
                                </p>
                                <p class="text-gray-400 text-xs">
                                    {{ count($liveMatches) == 1 ? 'match commenté' : 'matchs commentés' }}
                                </p>
                            </div>
                        @endif
                        <p class="text-white text-lg font-medium flex items-center mt-2">
                            J'y vais
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" class="w-5 h-5 mx-2" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                            </svg>
                        </p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    @livewire('home.load-commentators')
</div>
