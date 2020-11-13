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
    <header id="header" class="header bg-secondary relative">
        <div>
            <button id="burger" class="open-main-nav">
                <span class="burger"></span>
                <span class="burger-text">Menu</span>
            </button>
        </div>
        <div class="text-primary text-center pb-4 diagonale pt-3">
            <a href="/">
                <h1 class="text-lg"><span class="text-lg">balance ton match</h1>
                <p class="text-xs">Quand la touche part en live...</p>
            </a>
        </div>
        <div id="main-nav" class="main-nav">
            <nav>
                <ul class="text-xl">
                    <li class="mb-2"><a href="/">Accueil</a></li>
                    <li class="mb-2"><a href="{{ route('clubs.index') }}">Rechercher un club</a></li>
                    <li class="mb-2"><a href="{{ route('matches.index') }}">Liste des matchs</a></li>
                </ul>
            </nav>
            <div>
                @auth
                <div class="py-4 flex flex-row justify-center items-center">
                    <p class="font-bold px-4 capitalize text-primary z-auto">bonjour {{ Auth::user()->first_name }}</p>
                    <p><a class="btn btnPrimary" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a></p>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
                @else
                <div class="flex py-4 justify-center">
                    <a class="btn btnPrimary" href="/login">Login</a>
                    <a class="btn btnPrimary" href="/register">Register</a>
                </div>
                @endauth
            </div>
            @auth
            <div class="pl-4 h-72 w-96">
                <div class="p-4">
                    <h2>Mes teams <i class="fas fa-heart text-red-700"></i></h2>
                </div>
                @foreach($user->favoristeams as $favoriteam)
                <a href="{{ route('clubs.show', $favoriteam->club->id) }}">
                    <div class="flex items-center my-2">
                        <div class="logo h-10 w-10 cursor-pointer">
                            <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $favoriteam->club->numAffiliation }}.jpg" alt="logo">
                        </div>
                        <div class="ml-2">
                            {{ $favoriteam->club->name }}
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            @endauth
        </div>
    </header>
    @yield('content')
    <section class="m-0">
        <footer class="bg-gray-900 h-24">
            <h2 class="flex justify-center pt-10 text-secondary diagonale">Pied de page</h2>
        </footer>
    </section>

    <script src="{{ asset('js/app.js') }}"></script>
    @livewireScripts
</body>

</html>