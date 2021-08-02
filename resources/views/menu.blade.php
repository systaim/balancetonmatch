<div>
    <!-- NAV DESKTOP -->
    <nav class="navbar relative hidden xl:flex justify-center mt-4" x-data="{ open: false }">
        <div class="flex items-center">
            <a href="/">Accueil</a>
            <a href="{{ route('clubs.index') }}">Rechercher un club</a>
            <!-- <li id="menuRegions"class="mb-4 border-b border-black text-xl md:text-3xl lg:text-4xl uppercase"><a href="{{ route('matches.index') }}">Liste des matchs</a></li> -->
            <div class="dropdown">
                <button class="dropbtn" @click="open = true">Liste des matchs <i class="fa fa-caret-down"></i></button>
                <div class="dropdown-content" x-show="open" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0 h-0" @click.away="open = false">
                    <div x-data="{ open: false }">
                        <div>
                            <a href="/matches">Les prochains matchs</a>
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
    <div class="absolute right-0 top-0 m-2 text-white hidden lg:block w-80 lg:mr-4" x-data="{ open : false }">
        @auth
            <div class="flex justify-center items-center px-2 py-1 cursor-pointer text-primary" @click="open = true">
                <img class="rounded-full h-8 w-8 object-cover mr-4 mb-2" src="{{ Auth::user()->profile_photo_url }}">
                <div id="btnMenu" class="focus:outline-none">Bonjour {{ Auth::user()->first_name }} <i
                        class="fas fa-caret-down"></i></div>
            </div>
        @else
            <div class="flex justify-evenly items-center p-4">
                <a class="text-primary" href="/login">Se connecter</a>
                <a href="/register">
                    <button class="btn btnPrimary">S'enregistrer</button>
                </a>
            </div>
        @endauth
        <div id="menuUser"
            class="absolute z-50 border bg-primary rounded-lg shadow-lg overflow-hidden left-0 right-0 w-full"
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
                <a class="px-6 py-4 hover:bg-blue-900 block" href="{{ route('matches.create') }}">
                    Je crée un match
                </a>
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
<!-- NAV MOBILE -->
<div id="main-nav" class="main-nav">
    <div class="relative rounded-bl-full shadow-2xl py-12 bg-primary text-white lg:hidden">
        <div class="">
            <div class="flex justify-center items-start">
                <img class="w-2/12" src="{{ asset('images/logos/btmLogoJB.png') }}" alt="logo">
            </div>
            @auth
                <div class="flex flex-col justify-end mt-2">
                    <div class="flex flex-row justify-center items-center px-4">
                        <nav class="overflow-hidden w-full">
                            <div class="flex justify-center">
                                <div class="mr-6">
                                    @auth
                                        <a class="p-2 hover:bg-blue-900 block" href="/user/profile">Mon profil</a>
                                        @if (Auth::user()->club)
                                            <a class="p-2 hover:bg-blue-900 block"
                                                href="/clubs/{{ Auth::user()->club->id }}"><span class="text-sm">Mon
                                                    club</span></br>{{ Auth::user()->club->name }}</a>
                                        @endif
                                    </div>
                                    <div>
                                        @canany(['isSuperAdmin', 'isAdmin'])
                                            <a class="p-2 hover:bg-blue-900 block" href="{{ route('matches.create') }}">
                                                Je crée un match
                                            </a>
                                            <a class="p-2 hover:bg-blue-900 block" href="/admin">
                                                Page admin
                                            </a>
                                        @endcanany
                                    </div>
                                    <a class="absolute bottom-2 right-6 p-2 hover:bg-blue-900 block"
                                        href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                                                                                                                                                                                                                            document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                @else
                                    <ul class="list-none">
                                        <a class="py-2 hover:bg-blue-900 block" href="/login">Se connecter</a>
                                        <a class="py-2 hover:bg-blue-900 block" href="/register">S'enregistrer</a>
                                    </ul>
                                @endauth
                            </div>
                        </nav>
                    </div>
                </div>
            @else
                <div class="text-center flex flex-row justify-evenly mt-8">
                    <div class="">
                        <a class="btn btnSecondary" href="/login">{{ __('Login') }}</a>
                        <a class="" href="/register">{{ __('Register') }}</a>
                    </div>
                </div>
            @endauth
        </div>
    </div>
    <nav class="xl:hidden mt-12 flex flex-col items-center justify-start w-4/5 lg:h-screen">
        <ul class="w-10/12 m-auto">
            <li class=" mb-4 border-b border-black text-xl md:text-3xl lg:text-4xl uppercase"><a href="/">Accueil</a>
            </li>
            <li class=" mb-4 border-b border-black text-xl md:text-3xl lg:text-4xl uppercase"><a
                    href="{{ route('clubs.index') }}">Rechercher un club</a></li>
            <!-- <li id="menuRegions"class="mb-4 border-b border-black text-xl md:text-3xl lg:text-4xl uppercase"><a href="{{ route('matches.index') }}">Liste des matchs</a></li> -->
            <li id="menuRegions"
                class="cursor-pointer mb-4 border-b border-black text-xl md:text-3xl lg:text-4xl uppercase">
                Liste des matchs</li>
            <ul id="sousMenuRegions" class="pl-12">
                {{-- <li><a href="/matches">Les prochains matchs</a></li> --}}
                <li>Les matchs par régions</li>
                <ul class="pl-12">
                    <li class=""><a href="/regions/1">Auvergne - Rhones-Alpes</a></li>
                    <li class=""><a href="/regions/2">Bourgogne - Franche Comté</a></li>
                    <li class=""><a href="/regions/3">Bretagne</a></li>
                    <li class=""><a href="/regions/4">Centre Val de Loire</a></li>
                    <li class=""><a href="/regions/5">Corse</a></li>
                    <li class=""><a href="/regions/6">Grand Est</a></li>
                    <li class=""><a href="/regions/7">Guadeloupe</a></li>
                    <li class=""><a href="/regions/8">Guyane</a></li>
                    <li class=""><a href="/regions/9">Hauts de France</a></li>
                    <li class=""><a href="/regions/10">Martinique</a></li>
                    <li class=""><a href="/regions/11">Mayotte</a></li>
                    <li class=""><a href="/regions/12">Méditerranée</a></li>
                    <li class=""><a href="/regions/13">Normandie</a></li>
                    <li class=""><a href="/regions/14">Nouvelle Aquitaine</a></li>
                    <li class=""><a href="/regions/15">Occitanie</a></li>
                    <li class=""><a href="/regions/16">Paris IDF</a></li>
                    <li class=""><a href="/regions/17">Pays de la Loire</a></li>
                    <li class=""><a href="/regions/18">Réunion</a></li>
                    <li class=""><a href="/regions/19">St Pierre & Miquelon</a></li>
                </ul>
            </ul>
            <li class=" mb-4 border-b border-black text-xl md:text-3xl lg:text-4xl uppercase"><a
                    href="/contact">Contact</a></li>
        </ul>
    </nav>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
