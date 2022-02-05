<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#091c3e" />

    <!-- meta Facebook -->
    <meta property="og:url" content="{{ route('matches.show', [$match, Str::slug($match->slug, '-')]) }}" />
    <meta property="og:title"
        content="Balance ton match ! {{ $match->homeclub->name }} {{ $match->live != 'attente' ? $match->home_score . ' - ' . $match->away_score : 'VS' }} {{ $match->awayclub->name }}" />
    <meta property="og:type" content="Direct Live" />
    <meta property="og:description"
        content=" {{ 'Match entre ' . $match->homeclub->name . ' et ' . $match->awayclub->name }}" />
    @if ($match->home_score > $match->away_score)
        @if ($match->homeClub->logo_path)
            <meta property="og:image:url" content="{{ asset($match->homeClub->logo_path) }}" />
        @else
            <meta property="og:image:url"
                content="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->homeClub->numAffiliation }}.jpg" />
        @endif
    @elseif ($match->home_score < $match->away_score)
        @if ($match->awayClub->logo_path)
            <meta property="og:image:url" content="{{ asset($match->awayClub->logo_path) }}" />
        @else
            <meta property="og:image:url"
                content="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->awayClub->numAffiliation }}.jpg" />
        @endif
    @else
        @if ($match->competition_id == 3)
            <meta property="og:image:url" content="{{ asset('images/Coupe-de-france.jpg') }}" />
        @elseif ($match->competition_id == 4)
            <meta property="og:image:url" content="{{ asset('images/bzh.png') }}" />
        @else
            <meta property="og:image:url" content="{{ asset('images/amicaux.jpg') }}" />
        @endif
    @endif
    <!-- Meta du site -->
    <title>Balance ton match ! {{ $match->homeclub->name }}
        {{ $match->home_score == null ? ' VS ' : $match->home_score . ' - ' . $match->away_score }}
        {{ $match->awayclub->name }}</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/styles.css') }}" />

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>

    <!-- SplideJS -->
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@2.4.21/dist/js/splide.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@2.4.21/dist/css/splide.min.css" />



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

    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('500acb0f4d3b2c9db2e8', {
            cluster: 'eu'
        });

        var channel = pusher.subscribe('match');
        channel.bind('matchBegin', function(data) {
            alert(JSON.stringify(data));
        });
    </script>

    <!-- Google Ads-->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7237777700901740"
        crossorigin="anonymous"></script>

    {{-- Manifest --}}
    {{-- <link rel="manifest" href="manifest.json"> --}}
</head>

<body>

    {{-- preloader --}}
    <div class="preloader">
        <div class="loader"></div>
    </div>

    {{-- @auth
        @if ($match->live == 'attente')
            <div id="annonce" class="fixed bottom-16 inset-x-0 pb-2 sm:pb-5 z-50">
                <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
                    <div class="p-2 rounded-lg bg-orange-600 shadow-lg sm:p-3">
                        <div class="flex items-center justify-between flex-wrap">
                            <div class="w-0 flex-1 flex items-center">
                                <span class="flex p-2 rounded-lg bg-orange-700">
                                    <!-- Heroicon name: outline/speakerphone -->
                                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                    </svg>
                                </span>
                                <p class="ml-3 font-medium text-white truncate">
                                    <span class="md:hidden">
                                        L'heure du match n'est peut être pas bonne
                                    </span>
                                    <span class="hidden md:inline">
                                        Live ! L'heure du match n'est peut être pas bonne
                                    </span>
                                </p>
                            </div>
                            <div class="order-3 mt-2 flex-shrink-0 w-full sm:order-2 sm:mt-0 sm:w-auto">
                                <a href="{{ route('matches.edit', ['match' => $match]) }}"
                                    class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-blue-800 bg-white">
                                    Modifier l'heure
                                </a>
                            </div>
                            <div class="order-2 flex-shrink-0 sm:order-3 sm:ml-2">
                                <button type="button" onclick="closeWindow()"
                                    class="-mr-1 flex p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-white">
                                    <span class="sr-only">Dismiss</span>
                                    <!-- Heroicon name: outline/x -->
                                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    function closeWindow() {
                        let annonce = document.getElementById('annonce')
                        annonce.style.display = "none"
                    }
                </script>
            </div>
        @endif
    @endauth --}}


    <div id="container">
        <header class="relative top-O right-0 left-0 bg-white xl:h-auto z-50 lg:mt-0">
            <div id="burger"
                class="hidden absolute cursor-pointer top-5 left-3 justify-center items-center h-12 w-12 bg-primary z-50">
                <div class="open-main-nav flex justify-center">
                    <span class="burger"></span>
                </div>
            </div>
            <div
                class="relative text-primary flex justify-center lg:justify-between items-center lg:items-between lg:block lg:h-auto shadow-xl">
                <div class="relative flex justify-start lg:justify-center items-center mx-2 w-full">
                    <div class="flex items-center">
                        <div class="mx-auto">
                            <a href="/">
                                <img class="w-16 md:w-24 my-2" src="{{ asset('/images/logos/btmLogoJB.png') }}"
                                    alt="logo de BTM">
                            </a>
                        </div>
                        <div class="relative h-auto md:diagonale">
                            <a href="/">
                                <h1 class="text-xs md:text-3xl">Balance Ton Match</h1>
                                <p
                                    class="float-right inline-block text-xs60 sm:text-xs md:text-base px-2 bg-primary rounded-md text-white ">
                                    Quand la touche part en live...
                                </p>
                            </a>
                        </div>
                    </div>
                    <div class="absolute top-3 right-0 lg:hidden">
                        <a href=" /notifications">
                            <div
                                class="relative flex justify-center items-center text-primary border rounded-full h-12 w-12 mr-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                @auth
                                    <p id="js-count"
                                        class="absolute -top-1 right-0 bg-red-500 rounded-full text-xs text-white flex items-center justify-center h-5 w-5">
                                        {{ Auth::user()->unreadNotifications->count() }}</p>
                                @endauth
                            </div>
                        </a>
                    </div>
                </div>
                @include('menu')
            </div>
        </header>
        <div>
            @if (session()->has('success') || session()->has('warning') || session()->has('danger'))
                <div
                    class="fixed inset-0 flex items-end px-4 py-6 pointer-events-none sm:p-6 sm:items-start disparition z-50">
                    <div class="w-full flex flex-col items-center space-y-4 sm:items-end">
                        <div id="alert"
                            class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden">
                            <div class="p-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        @if (session('success'))
                                            <!-- Heroicon name: outline/check-circle -->
                                            <svg class="h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        @elseif (session('warning') || session('danger'))
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="ml-3 w-0 flex-1 pt-0.5">
                                        <p class="text-sm font-medium text-gray-900">
                                            @if (session('success'))
                                                Succes !
                                            @elseif(session('warning') || session('danger'))
                                                Une erreur s'est produite !
                                            @endif

                                        </p>
                                        <p class="mt-1 text-sm text-gray-500">
                                            {{ session('success') }}
                                            {{ session('warning') }}
                                            {{ session('danger') }}
                                        </p>
                                    </div>
                                    <div class="ml-4 flex-shrink-0 flex">
                                        <button onclick="document.getElementById('alert').style.display = 'none';"
                                            class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            <span class="sr-only">Close</span>
                                            <!-- Heroicon name: solid/x -->
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            {{-- @if (\Session::has('success'))
                <div class="message-alert success " x-show.transition="open">
                    <i class="fas fa-check-circle text-5xl text-white rounded-full shadow-xl m-4"></i>
                    <p> {!! \Session::get('success') !!}</p>
                </div>
            @endif
            @if (\Session::has('warning'))
                <div class="message-alert warning ">
                    <i class="fas fa-exclamation-circle"></i>
                    <p> {!! \Session::get('warning') !!}</p>
                </div>
            @endif
            @if (\Session::has('danger'))
                <div class="message-alert danger ">
                    <i class="fas fa-times-circle text-5xl text-white rounded-full shadow-xl m-4"></i>
                    <p> {!! \Session::get('danger') !!}</p>
                </div>
            @endif --}}
        </div>
    </div>

    <div class="relative">

        @livewire('form-commentaires', [
        'commentator'=> $commentator,
        'nbrFavoris'=> $nbrFavoris,
        'match' =>$match,
        'clubHome' => $clubHome,
        'clubAway' => $clubAway,
        'commentsMatch' => $commentsMatch,
        'competitions' => $competitions,
        'stats' => $stats,
        'tabHome' => $tabHome,
        'tabAway' => $tabAway,
        'favorimatch' => $favorimatch,
        'favoriteam' => $favoriteam,
        ])
    </div>

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7237777700901740"
        crossorigin="anonymous"></script>
    <!-- bas match -->
    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-7237777700901740" data-ad-slot="7950981944"
        data-ad-format="auto" data-full-width-responsive="true"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>

    @include('footer')

    <a href=javascript:history.go(-1)>
        <div
            class="fixed bottom-16 left-3 lg:hidden shadow-xl flex justify-center items-center rounded-full 
                h-12 w-12 bg-white z-30 border border-darkSuccess">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
            </svg>
        </div>
    </a>

</body>

@livewireScripts
@auth
    <script>
        window.User = {
            id: {{ optional(auth()->user())->id }}
        }
    </script>
@endauth

<script src="{{ mix('js/app.js') }}"></script>

</html>
