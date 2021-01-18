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

</head>

<body>
    <div id="burger" class="absolute cursor-pointer top-5 left-3 flex justify-center items-center h-12 w-12 bg-primary z-50">
        <div class="open-main-nav flex justify-center">
            <span class="burger"></span>
        </div>
    </div>
    <div id="container">
        <header id="header" class="relative bg-gray-100 h-24">
            <div class="relative text-primary flex justify-end sm:justify-center items-center mr-6 h-24">
                <!-- logo grande page -->
                <div class="relative w-10/12 md:w-8/12 lg:w-6/12">
                    <a href="/">
                        <div class="flex justify-center items-center">
                            <div>
                                <img class="w-20 md:w-24" src="{{ asset('images/logos/btmLogoJB.png') }}" alt="">
                            </div>
                            <div class="h-auto relative">
                                <h1 class="sm:text-2xl md:text-3xl">Balance Ton Match</h1>
                                <p class="float-right inline-block text-xs60 sm:text-xs md:text-base px-2 bg-primary rounded-lg text-white ">Quand la touche part en live...</p>
                                <p class="absolute top-0 -right-2 font-semibold z-10 px-2 py-1 bg-secondary rounded-md text-xxs">Bêta</p>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- logo(texte) -->
                <!-- <div class="flex justify-center col-start-6 col-end-12 lg:col-span-6 mt-2">
                    <div class="relative flex flex-col items-center h-full diagonale text-lg md:text-xl lg:text-4xl">
                        <a href="/">
                            <h1 class="capitalize">balance ton match</h1>
                        </a>
                        <p class=" text-xs px-2 bg-primary rounded-lg text-white md:text-base">Quand la touche part en live...</p>
                        <div>
                            <p class=" absolute top-0 right-2 text-xs px-2 bg-orange-600 text-black shadow-2xl rounded-md">Bêta</p>
                        </div>
                    </div>
                </div> -->
                <!-- icone login -->
                <div class="absolute right-2 top-5 text-white hidden lg:block w-64 lg:mr-4" x-data="{ open : false }">
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
            <!-- <div class="hidden lg:flex justify-center">
                <a class="p-2 text-primary underline rounded-lg m-1 " href="/clubs">Rechercher un club</a>
                <a class="p-2 text-primary underline rounded-md m-1" href="/matches">Matchs à venir</a>
            </div> -->
            <div id="main-nav" class="main-nav">
                <div class="w-full rounded-b-lg shadow-2xl py-12 bg-primary text-white">
                    <div>
                        <div class="flex justify-center items-start">
                            <img class="w-3/12 lg:w-2/12" src="images/logos/btmLogoJB.png" alt="logo">
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
                <nav class="mt-10">
                    <ul class="text-2xl md:text-3xl lg:text-4xl lguppercase flex flex-col items-center justify-center">
                        <li class="pb-4 mb-4 border-b border-black w-8/12"><a href="/">Accueil</a></li>
                        <li class="pb-4 mb-4 border-b border-black w-8/12"><a href="{{ route('clubs.index') }}">Rechercher un club</a></li>
                        <li class="pb-4 mb-4 border-b border-black w-8/12"><a href="{{ route('matches.index') }}">Matchs à venir</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        @yield('content')
        @include('footer')
    </div>
    @livewireScripts
    <script src="{{ asset('js/app.js') }}"></script>
</body>


</html>