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
    <link rel="stylesheet" href="{{ mix('css/app.css') }}?ver=1.04">
    <link rel="stylesheet" href="{{ mix('css/styles.css') }}?ver=1.04" />
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/c03c2336c3.js" crossorigin="anonymous"></script>

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
                                <i class="far fa-bell"></i>
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
            @if (\Session::has('success'))
                <div class="message-alert success" x-show.transition="open">
                    <i class="fas fa-check-circle text-5xl text-white rounded-full shadow-xl m-4"></i>
                    <p> {!! \Session::get('success') !!}</p>
                </div>
            @endif
            @if (\Session::has('warning'))
                <div class="message-alert warning">
                    <i class="fas fa-exclamation-circle"></i>
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
    </div>

    @if (request()->path() != '/')
        <a href=javascript:history.go(-1)>
            <div
                class="fixed bottom-16 left-3 lg:hidden shadow-xl flex justify-center items-center rounded-full 
                    h-12 w-12 bg-white z-50 border border-darkSuccess">
                <i class="fas fa-chevron-left mr-1 text-primary">
            </div>
        </a>
    @endif
    @auth
        @foreach (Auth::user()->commentators as $com)
            @if ($com->match['live'] != 'fin de match' && $com->created_at > now()->subHours(6))
                <div
                    class="fixed bottom-16 right-1 bg-primary text-white px-2 py-1 z-50 flex items-center rounded-lg shadow-xl">
                    <div class="h-3 w-3 bg-red-600 rounded-full animate-pulse mr-1"></div>
                    <div>
                        <a href="{{ route('matches.show', [$com->match, Str::slug($com->match['slug'], '-')]) }}"
                            class="text-xs">Je suis</a>
                        <p class="text-xs">le commentateur</p>
                    </div>
                </div>
            @endif
        @endforeach
    @endauth



    @livewireScripts

    @auth
        <script>
            window.User = {
                id: {{ optional(auth()->user())->id }}
            }
        </script>
    @endauth

    <script src="{{ mix('js/app.js') }}?ver=1.04"></script>

</body>


</html>
