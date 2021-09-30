<footer class="bg-gray-900 mb-0 pb-16 md:pb-2 w-full relative bottom-0 h-auto lg:mt-16">
    <div class="flex flex-col items-center text-white py-3">
        <div class="flex justify-center p-2">
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
                    <i class="fas fa-home text-xl"></i>
                    <p class="text-xs">Accueil</p>
                </div>
            </a>
            <a href="{{ Route('clubs.index') }}">
                <div class="flex flex-col items-center justify-center w-16">
                    <i class="fas fa-search text-xl"></i>
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
                    <i class="far fa-list-alt text-xl"></i>
                @endif
                <p class="text-xs">Matchs</p>
            </div>
            @auth
                <div id="profile" class="cursor-pointer flex flex-col items-center justify-center w-16">
                    <i class="fas fa-user-cog text-xl"></i>
                    <p class="text-xs">Profil</p>
                </div>
            @else
                <div id="profile" class="cursor-pointer flex flex-grow-0 flex-col items-center justify-center w-16">
                    <i class="fas fa-user-check text-xl"></i>
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
                    <i class="far fa-star text-4xl"></i>
                    <p class="text-md">Mes favoris</p>
                </div>
            </a>
            <a href="/contact">
                <div class="flex flex-col justify-center items-center w-36 m-2 rounded-md">
                    <i class="far fa-envelope text-4xl"></i>
                    <p class="text-md">Contact</p>
                </div>
            </a>
            @canany(['isSuperAdmin', 'isAdmin'])
                <a href="/admin">
                    <div class="flex flex-col justify-center items-center w-36 m-2 rounded-md">
                        <i class="fas fa-user-shield text-4xl"></i>
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
                    <i class="far fa-plus-square text-4xl"></i>
                    <p class="text-md">Créer un match</p>
                </div>
            </a> --}}
            <a href="{{ route('competitions.index') }}">
                <div class="flex flex-col justify-center items-center w-36 m-2 rounded-md">
                    <i class="far fa-futbol text-4xl"></i>
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
                        <i class="far fa-play-circle text-4xl"></i>
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
                        <i class="fas fa-user-cog text-4xl"></i>
                        <p class="text-md">Profil</p>
                    </div>
                </a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    <div class="flex flex-col justify-center items-center w-36 m-2 rounded-md">
                        <i class="fas fa-power-off text-4xl"></i>
                        <p class="text-md">Déconnexion</p>
                    </div>
                </a>
            @else
                <a href="/login">
                    <div class="flex flex-col justify-center items-center w-36 m-2 rounded-md">
                        <i class="fas fa-user-check text-4xl"></i>
                        <p class="text-md">Connexion</p>
                    </div>
                </a>
                <a href="/register">
                    <div class="flex flex-col justify-center items-center w-36 m-2 rounded-md">
                        <i class="fas fa-user-plus text-4xl"></i>
                        <p class="text-md">Inscription</p>
                    </div>
                </a>
            @endauth
        </div>
    </div>
</footer>
