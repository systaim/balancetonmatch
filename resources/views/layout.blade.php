<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balance Ton Match</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/styles.css') }}" />
    <script src="https://kit.fontawesome.com/c03c2336c3.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>
    <script data-ad-client="ca-pub-7237777700901740" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

</head>

<body>
    <div id="container">
        <header id="header" class="relative bg-gray-100 h-24 xl:h-auto">
            <div id="burger" class="xl:hidden absolute cursor-pointer top-5 left-3 flex justify-center items-center h-12 w-12 bg-primary z-50">
                <div class="open-main-nav flex justify-center">
                    <span class="burger"></span>
                </div>
            </div>
            <div class="relative text-primary flex xl:flex-col justify-end sm:justify-center xl:justify-between items-center xl:items-between h-24 xl:block xl:h-auto">
                <!-- logo grande page -->
                <div class="relative">
                    <a href="/">
                        <div class="flex justify-center items-center mx-8">
                            <div>
                                <img class="w-20 md:w-24" src="{{ asset('/images/logos/btmLogoJB.png') }}" alt="logo de BTM">
                            </div>
                            <div class="h-auto relative">
                                <h1 class="sm:text-2xl md:text-3xl">Balance Ton Match</h1>
                                <p class="float-right inline-block text-xs60 sm:text-xs md:text-base px-2 bg-primary rounded-lg text-white ">Quand la touche part en live...</p>
                            </div>
                        </div>
                    </a>
                </div>
                <nav class="navbar relative hidden xl:flex justify-center mt-4" x-data="{ open: false }">
                    <div class="flex items-center">
                        <a href="/">Accueil</a>
                        <a href="{{ route('clubs.index') }}">Rechercher un club</a>
                        <!-- <li id="menuRegions"class="mb-4 border-b border-black text-xl md:text-3xl lg:text-4xl uppercase"><a href="{{ route('matches.index') }}">Liste des matchs</a></li> -->
                        <div class="dropdown">
                            <button class="dropbtn" @click="open = true">Liste des matchs <i class="fa fa-caret-down"></i></button>
                            <div class="dropdown-content" x-show="open" @click.away="open = false">
                                <div>
                                    <a href="/matches">Tous les matches</a>
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
                        <a href="/contact">Contact</a>
                    </div>
                </nav>
                <div class="absolute right-2 top-6 text-white hidden lg:block w-64 lg:mr-4" x-data="{ open : false }">
                    @auth
                    <div class="flex justify-center items-center px-2 py-1 cursor-pointer text-primary" @click="open = true">
                        <img class="rounded-full h-8 w-8 object-cover mr-4 mb-2" src="{{ Auth::user()->profile_photo_url }}">
                        <div id="btnMenu" class="focus:outline-none">Bonjour {{ Auth::user()->first_name }} <i class="fas fa-caret-down"></i></div>
                    </div>
                    @else
                    <div class="flex justify-end pr-6 cursor-pointer" @click="open = true">
                        <div id="btnMenu" class="focus:outline-none text-primary ml-2">
                            <i class="far fa-user text-xl"></i> <i class="fas fa-caret-down"></i>
                        </div>
                    </div>
                    @endauth
                    <div id="menuUser" class="absolute z-50 bg-primary rounded-lg shadow-lg overflow-hidden left-0 w-full" x-show="open" @click.away="open = false">
                        <div class="mt-4">
                            @auth
                            <div class="px-6 py-4 hover:bg-blue-900"><a href="/user/profile">Mon profil</a></div>
                            @if(Auth::user()->club)
                            <div class="px-6 py-2 hover:bg-blue-900">
                                <p class="text-sm">Mon club</p>
                                <a href="/clubs/{{Auth::user()->club->id }}">{{Auth::user()->club->name }}</a>
                            </div>
                            @endif
                            <div class="px-6 py-4 hover:bg-blue-900">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                            </div>
                            @else
                            <ul class="list-none">
                                <li class="px-6 py-4 hover:bg-blue-900"><a href="/login">Se connecter</a></li>
                                <li class="px-6 py-4 hover:bg-blue-900"><a href="/register">S'enregistrer</a></li>
                            </ul>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            <div id="main-nav" class="main-nav">
                <div class="w-4/5 rounded-b-lg shadow-2xl py-12 bg-primary text-white lg:hidden">
                    <div class="">
                        <div class="flex justify-center items-start">
                            <img class="w-2/12" src="{{ asset('images/logos/btmLogoJB.png') }}" alt="logo">
                        </div>
                        @auth
                        <div class="flex flex-col justify-end mt-6">
                            <div class="flex flex-row justify-center items-center px-4">
                                <nav class="overflow-hidden">
                                    <div class="flex justify-center">
                                        <div class="flex flex-col justify-center items-center mr-6">
                                            <img class="rounded-full h-8 w-8 object-cover mr-2 border border-white" src="{{ Auth::user()->profile_photo_url }}">
                                            <p class="font-bold capitalize text-lg">{{ Auth::user()->first_name }} {{ Auth::user()->lastst_name }} </p>
                                        </div>
                                        <ul class="ml-3">
                                            <li class="mb-2"><a href="/user/profile">Mon profil</a></li>
                                            @if(Auth::user()->club)
                                            <li class="mb-2 truncate"><a href="/clubs/{{Auth::user()->club->id }}">{{Auth::user()->club->name }}</a></li>
                                            @endif
                                            <li class="mb-2">
                                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
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
                    <ul class="">
                        <li class=" mb-4 border-b border-black text-xl md:text-3xl lg:text-4xl uppercase"><a href="/">Accueil</a></li>
                        <li class=" mb-4 border-b border-black text-xl md:text-3xl lg:text-4xl uppercase"><a href="{{ route('clubs.index') }}">Rechercher un club</a></li>
                        <!-- <li id="menuRegions"class="mb-4 border-b border-black text-xl md:text-3xl lg:text-4xl uppercase"><a href="{{ route('matches.index') }}">Liste des matchs</a></li> -->
                        <li id="menuRegions" class="cursor-pointer mb-4 border-b border-black text-xl md:text-3xl lg:text-4xl uppercase">Liste des matchs</li>
                        <ul id="sousMenuRegions" class="pl-12">
                            <li><a href="/matches">Tous les matchs</a></li>
                            <li>Par région</li>
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
                        <li class=" mb-4 border-b border-black text-xl md:text-3xl lg:text-4xl uppercase"><a href="/contact">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        @if (\Session::has('success'))
        <div class="message-alert success" x-show.transition="open">
            <i class="fas fa-check-circle text-5xl text-white rounded-full shadow-xl"></i>
            <p> {!! \Session::get('success') !!}</p>
        </div>
        @endif
        @if (\Session::has('warning'))
        <div class="message-alert warning">
            <i class="fas fa-exclamation-circle text-5xl text-white rounded-full shadow-xl"></i>
            <p> {!! \Session::get('warning') !!}</p>
        </div>
        @endif
        @if (\Session::has('danger'))
        <div class="message-alert danger">
            <i class="fas fa-times-circle text-5xl text-white rounded-full shadow-xl"></i>
            <p> {!! \Session::get('danger') !!}</p>
        </div>
        @endif
        @yield('content')
        @include('footer')
    </div>
    @livewireScripts
    <script src="{{ asset('js/app.js') }}"></script>
</body>


</html>