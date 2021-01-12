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
            <div class="relative text-primary flex justify-end sm:justify-center items-center mr-2 h-24">
                <!-- logo grande page -->
                <div class="relative w-8/12 md:w-6/12 lg:w-4/12 xl:w-3/12">
                    <a href="/">
                        <img src="{{ asset('images/logos/bandeauLogo-bleu.png') }}" alt="">
                        <p class="float-right inline-block text-xs px-2 bg-primary rounded-lg text-white md:text-base">Quand la touche part en live...</p>
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
            <div id="main-nav" class="main-nav bg-primary">
                <div class="w-full rounded-b-lg shadow-xl bg-darkGray pt-16 pb-4 bg-menu">
                    <div>
                        @auth
                        <div class="h-64 flex flex-col justify-end">
                            <div class="relative p-4 bg-darkGray rounded-lg text-white w-11/12 m-auto">
                                <div class="flex flex-row justify-center items-center px-4">
                                    <div class="logo h-24 w-24 bg-white rounded-full overflow-hidden absolute top--3 shadow-xl">
                                        <img class="object-contain" src="{{ asset('images/logos/btmLogoJB.png') }}" alt="">
                                    </div>
                                    <nav class="overflow-hidden">
                                        <p class="font-bold capitalize text-lg mt-8 mb-4">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
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
                                    </nav>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="w-full h-64 uppercase text-center flex flex-row justify-evenly items-center">
                            <div class="rounded-lg bg-darkGray flex flex-row justify-evenly items-center py-8 w-11/12">
                                <a class="btn text-white" href="/login">{{ __('Login') }}</a>
                                <a class="btn btnDark" href="/register">{{ __('Register') }}</a>
                            </div>
                        </div>
                        @endauth
                    </div>
                </div>
                <nav class="m-6">
                    <ul class="text-lg uppercase">
                        <li class="m-4"><a href="/"><i class="fas fa-home"></i> Accueil</a></li>
                        <li class="m-4"><a href="{{ route('clubs.index') }}"><i class="fas fa-search"></i> Rechercher un club</a></li>
                        <li class="m-4"><a href="{{ route('matches.index') }}"><i class="far fa-list-alt"></i> Liste des matchs</a></li>
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