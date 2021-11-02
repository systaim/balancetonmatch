<footer class="bg-gray-900 mb-0 pb-16 md:pb-2 w-full relative bottom-0 h-auto lg:mt-16">
    <div class="flex flex-col items-center text-white py-3">
        <div class="flex justify-center p-2 z-20">
            <a class="px-4" href="https://www.facebook.com/balancetonmatch" target="_blank"><img
                    src="{{ asset('images/logoFacebook.png') }}" alt="logo Facebook" class="w-10"></a>
            <!-- <a class="px-4" href="http://" target="_blank"><img src="{{ asset('images/logoInsta.png') }}" alt="logo Instagram" class="w-10"></a> -->
            <a class="px-4" href="https://twitter.com/BalanceMatch" target="_blank"><img
                    src="{{ asset('images/logoTwitter.png') }}" alt="logo Twitter" class="w-10"></a>
        </div>
        <div class="text-center m-2 p-2">
            <p class="font-bold mb-4">Plus d'infos...</p>
            <div class="flex flex-col">
                <a href="/mentions-legales">Mentions légales</a>
                <a href="/contact">Contact</a>
            </div>
        </div>
    </div>
    <div class="flex flex-col sm:flex-row items-center sm:justify-end text-sm text-white mr-4">
        <p class="p-1">BalanceTonMatch.com @ 2021</p>
        <p class="hidden sm:inline-block p-1"> | </p>
        <p class="p-1">créé et propulsé par Anthony</p>
    </div>

    {{-- MENU MOBILE --}}

    <div class="main-menu-mobile lg:hidden fixed right-0 left-0 bottom-0 h-14 bg-white rounded-t-sm z-50 text-primary">
        <div class="relative flex justify-around items-center h-full">
            <a href="/">
                <div class="flex flex-col items-center justify-center w-16 h-14">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                    <p class="text-xs">Accueil</p>
                </div>
            </a>
            <a href="{{ Route('clubs.index') }}">
                <div class="flex flex-col items-center justify-center w-16">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="text-xs">Clubs</p>
                </div>
            </a>
            <div id="burger2"
                class="cursor-pointer flex flex-shrink-0 flex-col justify-center items-center rounded-full h-16 w-16 bg-primary mb-4 border border-white z-50 ">
                <div class="open-main-nav flex justify-center">
                    <span class="burger"></span>
                </div>
            </div>
            <div id="matchs" class="cursor-pointer flex flex-col items-center justify-center w-16">
                @if (count($liveMatches) != 0)
                    <p class="bg-secondary text-primary h-5 w-5 rounded-full text-xs flex justify-center items-center">
                        {{ count($liveMatches) }}</p>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path
                            d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                    </svg>
                @endif
                <p class="text-xs">Matchs</p>
            </div>
            @auth
                <div id="profile" class="cursor-pointer flex flex-col items-center justify-center w-16">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="text-xs">Profil</p>
                </div>
            @else
                <div id="profile" class="cursor-pointer flex flex-grow-0 flex-col items-center justify-center w-16">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="text-xs truncate">Se connecter</p>
                </div>
            @endauth
        </div>
    </div>
    <div id="menu-mobile" class="invisible fixed bottom-0 w-full bg-white text-primary py-6 z-40">
        <div class="flex flex-wrap justify-center">
            @auth
                @if (Auth::check() && Auth::user()->club)
                    <a href="{{ route('clubs.show', [Auth::user()->club->id]) }}">
                        <div class="flex flex-col justify-center items-center w-36 m-2 rounded-md">
                            <div class="logo h-10 w-10 cursor-pointer border-2">
                                @if (Auth::user()->club->logo_path)
                                    <img class="object-contain" src="{{ asset(Auth::user()->club->logo_path) }}"
                                        alt="Logo de {{ Auth::user()->club->name }}">
                                @else
                                    <img class="object-contain"
                                        src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ Auth::user()->club->numAffiliation }}.jpg"
                                        alt="Logo de {{ Auth::user()->club->name }}">
                                @endif
                            </div>
                            <p class="text-md">Mon club</p>
                        </div>
                    </a>
                @endif
            @endauth
            <a href="/mon-espace/mes-favoris">
                <div class="flex flex-col justify-center items-center w-36 m-2 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                    <p class="text-md">Mes favoris</p>
                </div>
            </a>
            <a href="/contact">
                <div class="flex flex-col justify-center items-center w-36 m-2 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <p class="text-md">Contact</p>
                </div>
            </a>
            @canany(['isSuperAdmin', 'isAdmin'])
                <a href="/admin">
                    <div class="flex flex-col justify-center items-center w-36 m-2 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                        </svg>
                        <p class="text-md">Admin</p>
                    </div>
                </a>
            @endcanany
        </div>
    </div>
    <div id="menu-matchs" class="invisible fixed bottom-0 w-full bg-white text-primary py-6 z-40">
        <div class="flex flex-wrap justify-center">
            {{-- <a href="{{ route('matches.create') }}">
                <div class="flex flex-col justify-center items-center w-36 m-2 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>
                    <p class="text-md">Créer un match</p>
                </div>
            </a> --}}
            <a href="{{ route('competitions.index') }}">
                <div class="flex flex-col justify-center items-center w-36 m-2 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <p class="text-md text-center">Voir les competitions</p>
                </div>
            </a>
            <a href="/live">
                <div class="flex flex-col justify-center items-center w-36 m-2 rounded-md">
                    @if (count($liveMatches) != 0)
                        <p class="bg-secondary text-primary h-9 w-9 rounded-full flex justify-center items-center">
                            {{ count($liveMatches) }}
                        </p>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    @endif
                    <p class="text-md">Voir les lives</p>
                </div>
            </a>
        </div>
    </div>
    <div id="menu-profile" class="invisible fixed bottom-0 w-full bg-white text-primary py-6 z-40">
        <div class="flex flex-wrap justify-center">
            @auth
                <a href="/user/profile">
                    <div class="flex flex-col justify-center items-center w-36 m-2 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-md">Profil</p>
                    </div>
                </a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                    <div class="flex flex-col justify-center items-center w-36 m-2 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <p class="text-md">Déconnexion</p>
                    </div>
                </a>
            @else
                <a href="/login">
                    <div class="flex flex-col justify-center items-center w-36 m-2 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <p class="text-md">Connexion</p>
                    </div>
                </a>
                <a href="/register">
                    <div class="flex flex-col justify-center items-center w-36 m-2 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        <p class="text-md">Inscription</p>
                    </div>
                </a>
            @endauth
        </div>
    </div>
</footer>
