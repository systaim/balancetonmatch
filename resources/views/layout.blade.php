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
    <div id="burger" class="cursor-pointer top-2 left-2 flex justify-center items-center h-12 w-12 bg-primary z-50 lg:top-40 lg:left-50">
        <div class="open-main-nav flex justify-center">
            <span class="burger"></span>
            <!-- <span class="burger-text">Menu</span> -->
        </div>
    </div>
    <div id="container">
        <header id="header" class="relative bg-secondary text-primary p-0 h-16 sm:h-20 lg:h-36">
            <a href="/">
                <div class="absolute top-0 left-10 shadow-xl rounded-b-lg overflow-hidden hidden lg:block">
                    <img src="{{ asset('images/logos/btm1LogoSiteB.jpg') }}" width="150px" alt="">
                </div>
                <div class="absolute top-2 left-40">
                    <p class="hidden text-xs px-2 bg-orange-600 text-black shadow-2xl rounded-md lg:block">Bêta</p>
                </div>
                <div class="diagonale flex flex-col justify-center items-center h-full">
                    <h1 class="text-xl capitalize sm:text-2xl lg:text-4xl">balance ton match</h1>
                    <p class="text-xs px-2 bg-primary rounded-lg text-white sm:text-sm lg:text-base">Quand la touche part en live...</p>
                </div>
            </a>
    <!-- <div class="relative hidden lg:block" x-data="{ open : false }">
        <div class="relative inline-block text-left" @click="open = true">
            <div>
                <button type="button" class="inline-flex justify-center items-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500" id="options-menu" aria-haspopup="true" aria-expanded="true">
                    @auth
                    <i class="fas fa-user-astronaut text-lg"></i>
                    @else
                    <i class="fas fa-user-ninja text-lg"></i>
                    @endauth
                    <svg class="mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            <div class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5" x-show="open" @click.away="open = false">
                <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                    @auth
                    <a href="/user/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Mon profil</a>
                    @if(Auth::user()->club)
                    <a href="/clubs/{{Auth::user()->club->id }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Ma team</a>
                    @else
                    <a href="{{route('matches.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Pas d'équipe ? GO!</a>
                    @endif
                    <input type="text" name="text" id="">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">
                        {{ __('Logout') }}
                    </a>
                    @else
                    <a href="/login" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Se connecter</a>
                    <a href="/register" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">S'enregistrer</a>
                    @endauth
                </div>
            </div>
        </div>
    </div> -->
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
    </div>
    @livewireScripts
    <script src="{{ asset('js/app.js') }}"></script>
</body>


</html>