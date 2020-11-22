<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balance Ton Match</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/styles.css') }}" />
    <script src="https://kit.fontawesome.com/c03c2336c3.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}"></script>

</head>

<body>
    <header id="header" class="header bg-primary relative">
        <div>
            <button id="burger" class="open-main-nav">
                <span class="burger"></span>
                <span class="burger-text">Menu</span>
            </button>
        </div>
        <div class="m-auto w-2/3 text-secondary text-center pb-4 diagonale pt-3">
            <a href="/">
                <h1 class="text-lg"><span class="text-lg">balance ton match</h1>
                <p class="text-xs">Quand la touche part en live...</p>
            </a>
        </div>
        <div id="main-nav" class="main-nav">
            <div class="w-full rounded-b-lg shadow-xl bg-darkGray pt-16 pb-4 bg-menu">
                <div>
                    @auth
                    <div class="py-4 h-64 flex flex-col justify-end">
                        <div class="flex flex-row items-center mb-8 mx-4">
                            <div class="h-24 w-24 bg-white rounded-full m-4 overflow-hidden">
                                <img class="object-contain" src="/images/avatar.png" alt="">
                            </div>
                            <div>
                                <p class="font-bold px-4 capitalize z-auto text-white bg-darkGray rounded-lg">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                            </div>
                        </div>
                        <div>
                            <a class="btn text-center" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                    @else
                    <div class="w-full h-64 uppercase text-center rounded-lg flex flex-col justify-end">
                        <a class="btn" href="/login">{{ __('Login') }}</a>
                        <a class="btn" href="/register">{{ __('Register') }}</a>
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

    <script src="{{ asset('js/app.js') }}"></script>
    @livewireScripts
</body>

</html>