<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- meta Facebook -->
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:title" content="Balance ton match !">
    @isset($club)
        <meta property="og:description" content="{{ $club->name }}">
    @else
        <meta property="og:description" content="Quand la touche part en live...">
    @endisset

    @isset($club)
        <meta property="og:image" content="{{ asset($club->bg_path) }}">
    @else
        <meta property="og:image" content="https://balancetonmatch.com/images/logos/btmB1.jpg">
    @endisset()

    <title>Balance Ton Match</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/styles.css') }}" />
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <!-- FontAwesome -->
    {{-- <script src="https://kit.fontawesome.com/c03c2336c3.js" crossorigin="anonymous" defer></script> --}}

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>

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

    <!-- Captcha -->
    @if (request()->path() == 'contact')
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif
    @laravelPWA

</head>

<body>
    {{-- preloader --}}
    <div class="preloader">
        <div class="loader"></div>
    </div>
    @auth
        @foreach (Auth::user()->commentators as $com)
            @if ($com->match && $com->match['live'] != 'finDeMatch' && $com->created_at > now()->subHours(3))
                <div>
                    <a href="{{ route('matches.show', [$com->match, Str::slug($com->match['slug'], '-')]) }}">
                        <div
                            class="fixed bottom-16 right-1 bg-primary text-white px-2 py-1 z-30 flex items-center rounded-lg shadow-xl">
                            <div class="h-3 w-3 bg-red-600 rounded-full animate-pulse mr-1"></div>
                            <div>
                                <p class="text-xs">Je suis</p>
                                <p class="text-xs">le commentateur</p>
                            </div>
                        </div>
                    </a>
                </div>

            @endif
        @endforeach
    @endauth
    <div id="container">
        <header id="header" class="relative top-O right-0 left-0 lg:relative bg-white xl:h-auto z-50 lg:mt-0">
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
            @yield('content')
            @include('footer')
        </div>
    </div>

    @if (request()->path() != '/')
        <a href=javascript:history.go(-1)>
            <div
                class="fixed bottom-16 left-3 lg:hidden shadow-xl flex justify-center items-center rounded-full 
                    h-12 w-12 bg-white z-30 border border-darkSuccess">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                </svg>
            </div>
        </a>
    @endif



    @livewireScripts

    @auth
        <script>
            window.User = {
                id: {{ optional(auth()->user())->id }}
            }
        </script>
    @endauth

    <script src="{{ mix('js/app.js') }}"></script>

</body>


</html>
