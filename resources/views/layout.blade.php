<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balance Ton Match</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/styles.css') }}" />
    <script src="https://kit.fontawesome.com/c03c2336c3.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>

</head>

<body>
    <header id="header" class="bg-primary relative flex justify-around items-center">
        <div class="text-secondary text-center pb-4 diagonale pt-3">
            <a href="/">
                <h1 class="text-lg"><span class="text-lg">balance ton match</h1>
                <p class="text-xs">Quand la touche part en live...</p>
            </a>
        </div>
        <nav class="text-white hidden lg:block mx-2">
            <ul class="flex">
                <li class="mx-2"><a href="/"><i class="fas fa-home"></i> Accueil</a></li>
                <li class="mx-2"><a href="{{ route('clubs.index') }}"><i class="fas fa-search"></i> Rechercher un club</a></li>
                <li class="mx-2"><a href="{{ route('matches.index') }}"><i class="far fa-list-alt"></i> Liste des matchs</a></li>
            </ul>
        </nav>
        <div>
            <button id="burger" class="open-main-nav lg:hidden">
                <span class="burger"></span>
                <span class="burger-text">Menu</span>
            </button>
        </div>
        <div id="main-nav" class="main-nav bg-primary">
            <div class="w-full rounded-b-lg shadow-xl bg-darkGray pt-16 pb-4 bg-menu">
                <div>
                    @auth
                    <div class="h-64 flex flex-col justify-end">
                        <div class="relative p-4 bg-darkGray rounded-lg text-white w-11/12 m-auto">
                            <div class="flex flex-row justify-center items-center px-4">
                                @if(Auth::user()->club)
                                <div class="logo h-24 w-24 bg-white rounded-full overflow-hidden absolute top--3 shadow-xl">
                                    <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ Auth::user()->club->numAffiliation }}.jpg" alt="">
                                </div>
                                @endif
                                <div class="overflow-hidden">
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
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="w-full h-64 uppercase text-center flex flex-row justify-evenly items-center">
                        <div class="rounded-lg bg-darkGray flex flex-row justify-evenly items-center py-8 w-11/12">
                            <a class="" href="/login">{{ __('Login') }}</a>
                            <a class="btn btnDark" href="/register">{{ __('Register') }}</a>
                        </div>
                    </div>
                    @endauth
                </div>
            </div>
            <nav class="m-6 text-white">
                <ul class="text-lg uppercase">
                    <li class="m-4 border-b-2 border-secondary"><a href="/"><i class="fas fa-home"></i> Accueil</a></li>
                    <li class="m-4 border-b-2 border-secondary"><a href="{{ route('clubs.index') }}"><i class="fas fa-search"></i> Rechercher un club</a></li>
                    <li class="m-4 border-b-2 border-secondary"><a href="{{ route('matches.index') }}"><i class="far fa-list-alt"></i> Liste des matchs</a></li>
                </ul>
            </nav>
        </div>
    </header>
    @yield('content')
    @include('footer')

    @livewireScripts
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>