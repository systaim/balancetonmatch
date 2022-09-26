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
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v=1">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}?v=1" />
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <!-- Tinymce -->
    <x-head.tinymce-config />

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
        <!-- Google Ads-->
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7237777700901740"
            crossorigin="anonymous"></script>

</head>

<div class="relative" x-data="{ open_menu: false }" @keydown.window.escape="open_menu = false">
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
        @include('slide-over-menu')
    </div>
    <header id="header" class="top-O right-0 left-0 bg-white xl:h-auto z-50 lg:mt-0">
        <button @click="open_menu = ! open_menu"
            class="absolute cursor-pointer top-6 left-5 justify-center items-center z-40">
            {{-- <div class="open-main-nav flex justify-center">
            <span class="burger"></span>
        </div> --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 lg:h-12 w-8 lg:w-12" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <div
            class="relative text-primary flex justify-center lg:justify-between items-center lg:items-between lg:block lg:h-auto shadow-xl">
            <div class="relative flex justify-start lg:justify-center items-center mx-2 w-full">
                <div class="flex items-center justify-center w-full">
                    <div class="mx-auto flex items-center">
                        <a href="/">
                            <img class="w-16 md:w-24 my-2" src="{{ asset('/images/logos/btmLogoJB.png') }}"
                                alt="logo de BTM">
                        </a>
                        <div class="hidden lg:block relative h-auto md:diagonale">
                            <a href="/">
                                <h1 class="text-xs md:text-3xl">Balance Ton Match</h1>
                                <p
                                    class="float-right inline-block text-xs60 sm:text-xs md:text-base px-2 bg-primary rounded-md text-white ">
                                    Quand la touche part en live...
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="absolute top-3 right-0 lg:hidden">
                    <a href=" /notifications">
                        <div
                            class="relative flex justify-center items-center text-primary border rounded-full h-12 w-12 mr-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
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
                {{-- <script>
                        (function() {
                            // on cible l'objet nav
                            let header = document.getElementById('header');
                            // on mémorise la position de nav
                            let memoPositionNav = header.offsetTop;

                            function sticky() {
                                // position du curseur au scroll
                                var posCurseur = this.pageYOffset;
                                // je teste la différence de distance entre le scroll et nav
                                if (memoPositionNav - posCurseur < 1) {
                                    header.style.position = "fixed";
                                    header.style.top = 0;
                                    header.style.zIndex = 999;
                                }
                                if (posCurseur < header.clientHeight) {
                                    header.style.position = "relative";
                                }
                            }
                            // evenement
                            window.addEventListener("scroll", sticky);
                        })()
                    </script> --}}
            </div>
            @include('menu')
        </div>
    </header>
    <div>
        @include('toast')
        @yield('content')
        @include('footer')
    </div>
</div>

<div id="loaderPage" class="fixed inset-0 bg-primary bg-opacity-100 z-9999 flex justify-center items-center">
    <div class="flex flex-col items-center">
        <div class="flex justify-center items-baseline">
            <img src="{{ asset('images/favoris-mobile.png') }}" alt="" class="h-48">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-14 h-14 text-secondary animate-spin">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
            </svg>
        </div>
        <div class="text-white">
            Chargement...
        </div>
    </div>
</div>
<script>
    document.onreadystatechange = function() {
        if (document.readyState != "complete") {
            document.querySelector("body").style.visibility = "hidden";
            document.querySelector("#loaderPage").style.visibility = "visible";
        } else {
            document.querySelector("#loaderPage").style.display = "none";
            document.querySelector("body").style.visibility = "visible";
        }
    }
</script>

@if (request()->path() != '/')
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
@endif
<div class="fixed bottom-0 mx-auto flex justify-center left-0 right-0 bg-gray-100">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7237777700901740"
        crossorigin="anonymous"></script>
    <!-- bas de page -->
    <ins class="adsbygoogle" style="display:inline-block;width:90%;height:65px"
        data-ad-client="ca-pub-7237777700901740" data-ad-slot="8168194089"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
</div>
@livewireScripts

@auth
    <script>
        window.User = {
            id: {{ optional(auth()->user())->id }}
        }
    </script>
@endauth

<script src="{{ mix('js/app.js') }}"></script>
<script>
    window.axeptioSettings = {
        clientId: "{{ env('AXEPTIO_KEY ') }}",
        cookiesVersion: "balancetonmatch-base",
    };

    (function(d, s) {
        var t = d.getElementsByTagName(s)[0],
            e = d.createElement(s);
        e.async = true;
        e.src = "//static.axept.io/sdk.js";
        t.parentNode.insertBefore(e, t);
    })(document, "script");
</script>

</body>


</html>
