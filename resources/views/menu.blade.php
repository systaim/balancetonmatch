<div>
    <!-- NAV DESKTOP -->
    <nav class="navbar relative hidden xl:flex justify-center mt-4" x-data="{ open: false }">
        <div class="flex items-center">
            <a href="/">Accueil</a>
            <a href="{{ route('clubs.index') }}">Rechercher un club</a>
            <!-- <li id="menuRegions"class="mb-4 border-b border-black text-xl md:text-3xl lg:text-4xl uppercase"><a href="{{ route('matches.index') }}">Liste des matchs</a></li> -->
            <div class="dropdown">
                <button class="dropbtn" @click="open = true">Liste des matchs <i
                        class="fa fa-caret-down"></i></button>
                <div class="dropdown-content" x-show="open" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0 h-0" @click.away="open = false">
                    <div x-data="{ open: false }">
                        <div>
                            <a href="{{ route('competitions.index') }}">Les prochains matchs</a>
                        </div>
                        {{-- <div>
                            <a class="cursor-pointer" @click="open = true"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-300"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0 h-0">
                                Les matchs par régions
                            </a>
                            <div class="pl-4" x-show="open" @click.away="open = false">
                                <a href="/regions/1">Auvergne - Rhones-Alpes</a>
                                <a href="/regions/2">Bourgogne - Franche Comté</a>
                                <a href="/regions/3">Bretagne</a>
                                <a href="/regions/4">Centre Val de Loire</a>
                                <a href="/regions/5">Corse</a>
                                <a href="/regions/6">Grand Est</a>
                                <a href="/regions/7">Guadeloupe</a>
                                <a href="/regions/8">Guyane</a>
                                <a href="/regions/9">Hauts de France</a>
                                <a href="/regions/10">Martinique</a>
                                <a href="/regions/11">Mayotte</a>
                                <a href="/regions/12">Méditerranée</a>
                                <a href="/regions/13">Normandie</a>
                                <a href="/regions/14">Nouvelle Aquitaine</a>
                                <a href="/regions/15">Occitanie</a>
                                <a href="/regions/16">Paris IDF</a>
                                <a href="/regions/17">Pays de la Loire</a>
                                <a href="/regions/18">Réunion</a>
                                <a href="/regions/19">St Pierre & Miquelon</a>
                            </div>
                        </div> --}}

                    </div>
                </div>
            </div>
            <a href="/contact">Contact</a>
        </div>
    </nav>
    <button @click="openMenuMobile = ! openMenuMobile" class="bg-primary text-white h-12 w-12 flex justify-center items-center rounded-full absolute top-3 left-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
    <nav class="hidden fixed transform inset-0 bg-gray-200 bg-opacity-80 z-50" x-show="openMenuMobile"
        @click.outside="openMenuMobile = false">
        <div class="w-full h-full flex justify-center items-center">
            <ul class="text-3xl">
                <li class="my-2 p-2">Accueil</li>
                <li class="my-2 p-2">Rechercher un club</li>
                <li class="my-2 p-2">Liste des matchs</li>
                <li class="my-2 p-2">Conctact</li>
            </ul>
        </div>
    </nav>
    <div class="absolute right-0 top-0 m-2 text-white hidden lg:block lg:mr-4" x-data="{ open : false }">
        @auth
            <div class="flex items-center">
                <a href="/notifications">
                    <div class="relative flex justify-center items-center text-primary border rounded-full h-12 w-12 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <p id="js-count"
                            class="absolute -top-1 right-0 bg-red-500 rounded-full text-xs text-white flex items-center justify-center h-5 w-5">
                            {{ Auth::user()->unreadNotifications->count() }}</p>
                    </div>
                </a>
                <div class="flex justify-center items-center cursor-pointer text-primary mr-5 my-3 border rounded-full px-3 py-2"
                    @click="open = true">
                    <img class="rounded-full h-8 w-8 object-cover mr-4 border"
                        src="{{ Auth::user()->profile_photo_url }}">
                    <div id="btnMenu" class="focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>
        @else
            <div class="flex justify-evenly items-center p-4">
                <a class="text-primary" href="/login">Se connecter</a>
                <a href="/register">
                    <button class="btn btnPrimary">S'enregistrer</button>
                </a>
            </div>
        @endauth
        <div id="menuUser" class="absolute z-50 border bg-primary rounded-lg shadow-lg overflow-hidden right-4 w-80"
            x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 h-0" @click.away="open = false">
            <div>
                <a class="px-6 py-4 hover:bg-blue-900 block" href="/user/profile">Mon profil</a>
                @if (Auth::check() && Auth::user()->club)
                    <a class="px-6 py-4 hover:bg-blue-900 block" href="/clubs/{{ Auth::user()->club->id }}"><span
                            class="text-sm">Mon
                            club</span><br>{{ Auth::user()->club->name }}</a>
                @endif
                {{-- <a class="px-6 py-4 hover:bg-blue-900 block" href="{{ route('matches.create') }}">
                    Je crée un match
                </a> --}}
                @canany(['isSuperAdmin', 'isAdmin'])
                    <a class="px-6 py-4 hover:bg-blue-900 block" href="/admin">
                        Page admin
                    </a>
                @endcanany
                <a class="px-6 py-4 hover:bg-blue-900 block" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
            </div>
        </div>
    </div>
</div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
</div>
