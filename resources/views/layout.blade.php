<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- meta Facebook -->
    <meta property="og:url" content="https://www.balancetonmatch.com">
    <meta property="og:title" content="Balance ton match !">
    <meta property="og:description" content="Quand la touche part en live...">
    <meta property="og:image" content="https://balancetonmatch.com/images/logos/btmLogoJB.png">

    <title>Balance Ton Match</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/styles.css') }}" />
    <script src="https://kit.fontawesome.com/c03c2336c3.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>
    <script data-ad-client="ca-pub-7237777700901740" async
        src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-MWPW5WC37V"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-MWPW5WC37V');
    </script>
</head>

<body>
    <div id="container">
        <header id="header" class="relative bg-gray-100 h-24 xl:h-auto">
            <div id="burger"
                class="hidden absolute cursor-pointer top-5 left-3 justify-center items-center h-12 w-12 bg-primary z-50">
                <div class="open-main-nav flex justify-center">
                    <span class="burger"></span>
                </div>
            </div>
            <div
                class="relative text-primary flex xl:flex-col justify-center xl:justify-between items-center xl:items-between h-24 xl:block xl:h-auto">
                <div class="relative">
                    <div class="flex justify-center items-center mx-8">
                        <div>
                            <a href="/">
                                <img class="w-20 md:w-24" src="{{ asset('/images/logos/btmLogoJB.png') }}"
                                    alt="logo de BTM">
                            </a>
                        </div>
                        <div class="relative h-auto diagonale">
                            <a href="/">
                                <h1 class="sm:text-2xl md:text-3xl">Balance Ton Match</h1>
                                <p
                                    class="float-right inline-block text-xs60 sm:text-xs md:text-base px-2 bg-primary rounded-md text-white ">
                                    Quand la touche part en live...
                                </p>
                                <p class="float-left text-primary bg-secondary px-1 rounded-md text-xs">Beta</p>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- NAV DESKTOP -->
                <nav class="navbar relative hidden xl:flex justify-center mt-4" x-data="{ open: false }">
                    <div class="flex items-center">
                        <a href="/">Accueil</a>
                        <a href="{{ route('clubs.index') }}">Rechercher un club</a>
                        <!-- <li id="menuRegions"class="mb-4 border-b border-black text-xl md:text-3xl lg:text-4xl uppercase"><a href="{{ route('matches.index') }}">Liste des matchs</a></li> -->
                        <div class="dropdown">
                            <button class="dropbtn" @click="open = true">Liste des matchs <i
                                    class="fa fa-caret-down"></i></button>
                            <div class="dropdown-content" x-show="open"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-300"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 h-0"
                                @click.away="open = false">
                                <div x-data="{ open: false }">
                                    {{-- <a href="/matches">Les prochains matchs</a> --}}
                                    <div>
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
                                    </div>

                                </div>
                            </div>
                        </div>
                        <a href="/contact">Contact</a>
                    </div>
                </nav>
                <div class="absolute right-2 top-6 text-white hidden lg:block w-64 lg:mr-4" x-data="{ open : false }">
                    @auth
                        <div class="flex justify-center items-center px-2 py-1 cursor-pointer text-primary"
                            @click="open = true">
                            <img class="rounded-full h-8 w-8 object-cover mr-4 mb-2"
                                src="{{ Auth::user()->profile_photo_url }}">
                            <div id="btnMenu" class="focus:outline-none">Bonjour {{ Auth::user()->first_name }} <i
                                    class="fas fa-caret-down"></i></div>
                        </div>
                    @else
                        <div class="flex justify-end pr-6 cursor-pointer" @click="open = true">
                            <div id="btnMenu"
                                class="focus:outline-none text-gray-200 ml-2 bg-primary p-4 rounded-lg shadow-xl">
                                <i class="far fa-user text-xl"></i> <i class="fas fa-caret-down"></i>
                            </div>
                        </div>
                    @endauth
                    <div id="menuUser"
                        class="absolute z-50 border bg-primary rounded-lg shadow-lg overflow-hidden left-0 right-0 w-full"
                        x-show="open" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0 h-0" @click.away="open = false">
                        <div>
                            @auth
                                <a class="px-6 py-4 hover:bg-blue-900 block" href="/user/profile">Mon profil</a>
                                @if (Auth::user()->club)
                                    <a class="px-6 py-4 hover:bg-blue-900 block"
                                        href="/clubs/{{ Auth::user()->club->id }}"><span class="text-sm">Mon
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
                            @else
                                <ul class="list-none">
                                    <a class="px-6 py-4 hover:bg-blue-900 block" href="/login">Se connecter</a>
                                    <a class="px-6 py-4 hover:bg-blue-900 block" href="/register">S'enregistrer</a>
                                </ul>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            <!-- NAV MOBILE -->
            <div id="main-nav" class="main-nav">
                <div class="relative w-4/5 rounded-b-lg shadow-2xl py-12 bg-primary text-white lg:hidden">
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
                                                            href="/clubs/{{ Auth::user()->club->id }}"><span
                                                                class="text-sm">Mon
                                                                club</span></br>{{ Auth::user()->club->name }}</a>
                                                    @endif
                                                </div>
                                                <div>
                                                    @canany(['isSuperAdmin', 'isAdmin'])
                                                        <a class="p-2 hover:bg-blue-900 block"
                                                            href="{{ route('matches.create') }}">
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
                        <li class=" mb-4 border-b border-black text-xl md:text-3xl lg:text-4xl uppercase"><a
                                href="/">Accueil</a></li>
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
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </header>
        @if (\Session::has('success'))
            <div class="message-alert success" x-show.transition="open">
                <i class="fas fa-check-circle text-5xl text-white rounded-full shadow-xl m-4"></i>
                <p> {!! \Session::get('success') !!}</p>
            </div>
        @endif
        @if (\Session::has('warning'))
            <div class="message-alert warning">
                <i class="fas fa-exclamation-circle text-5xl text-white rounded-full shadow-xl m-4"></i>
                <p> {!! \Session::get('warning') !!}</p>
            </div>
        @endif
        @if (\Session::has('danger'))
            <div class="message-alert danger">
                <i class="fas fa-times-circle text-5xl text-white rounded-full shadow-xl m-4"></i>
                <p> {!! \Session::get('danger') !!}</p>
            </div>
        @endif
        @yield('content')
        @include('footer')
    </div>
    <div class="md:hidden fixed right-0 left-0 bottom-0 h-12 bg-gray-100 shadow-2xl rounded-t-sm z-50">
        <div class="flex justify-around items-center h-full">
            <a href="/">
                <div class="flex flex-col items-center justify-center">
                    <i class="fas fa-home text-xl"></i>
                    <p class="text-xs">Accueil</p>
                </div>
            </a>
            <a href="/clubs">
                <div class="flex flex-col items-center justify-center">
                    <i class="fas fa-futbol text-xl"></i>
                    <p class="text-xs">Clubs</p>
                </div>
            </a>
            {{-- <a href="#">
                <div class="flex justify-center items-center rounded-full h-16 w-16 bg-primary mb-4 shadow-outline">
                    <i class="far fa-bars text-4xl text-white shadow-2xl"></i>
                </div>
            </a> --}}
            <a href="/matches">
                <div class="flex flex-col items-center justify-center">
                    <i class="fas fa-list text-xl"></i>
                    <p class="text-xs">Matchs</p>
                </div>
            </a>
            <a href="/user/profile">
                <div class="flex flex-col items-center justify-center">
                    <i class="far fa-user text-xl"></i>
                    <p class="text-xs">Profil</p>
                </div>
            </a>
        </div>
    </div>
    @livewireScripts
    <script src="{{ asset('js/app.js') }}"></script>
</body>


</html>
