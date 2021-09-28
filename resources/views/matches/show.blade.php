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
        content=" {{ $match->competition->name . ' entre ' . $match->homeclub->name . ' et ' . $match->awayclub->name }}" />
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
    <link rel="stylesheet" href="{{ mix('css/app.css') }}?ver=1.03">
    <link rel="stylesheet" href="{{ mix('css/styles.css') }}?ver=1.03" />

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

    {{-- Manifest --}}
    {{-- <link rel="manifest" href="manifest.json"> --}}
</head>

<body>
    <div id="container">
        <header id="header"
            class="fixed top-O right-0 left-0 lg:relative bg-gray-100 xl:h-auto z-50 -mt-16 h-18 lg:h-auto lg:mt-0">
            <div id="burger"
                class="hidden absolute cursor-pointer top-5 left-3 justify-center items-center h-12 w-12 bg-primary z-50">
                <div class="open-main-nav flex justify-center">
                    <span class="burger"></span>
                </div>
            </div>
            <div
                class="relative text-primary flex justify-center lg:justify-between items-center lg:items-between lg:block lg:h-auto shadow-xl">
                <div class="relative flex justify-center items-center mx-2 w-full">
                    <div class="absolute top-4 left-5 lg:hidden flex items-center">
                        <i class="fas fa-chevron-left mr-1"></i>
                        <a href=javascript:history.go(-1)>retour</a>
                    </div>
                    <div class="flex items-center">
                        <div class="mx-auto">
                            <a href="/">
                                <img class="w-16 md:w-24" src="{{ asset('/images/logos/btmLogoJB.png') }}"
                                    alt="logo de BTM">
                            </a>
                        </div>
                        <div class="relative h-auto md:diagonale">
                            <a href="/">
                                <h1 class="hidden md:block md:text-3xl">Balance Ton Match</h1>
                                <p
                                    class="hidden float-right sm:inline-block text-xs60 sm:text-xs md:text-base px-2 bg-primary rounded-md text-white ">
                                    Quand la touche part en live...
                                </p>
                            </a>
                        </div>
                    </div>
                    <div class="absolute top-1 right-2 lg:hidden">
                        <a href=" /notifications">
                            <div
                                class="relative flex justify-center items-center text-primary border rounded-full h-12 w-12 mr-4">
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
        <div class="mt-16 lg:mt-0">
            @if (\Session::has('success'))
                <div class="message-alert success" x-show.transition="open">
                    <i class="fas fa-check-circle"></i>
                    <p> {!! \Session::get('success') !!}</p>
                </div>
            @endif
            @if (\Session::has('warning'))
                <div class="message-alert warning">
                    <i class="fas fa-exclamation-circle mr-4"></i>
                    <p> {!! \Session::get('warning') !!}</p>
                </div>
            @endif
            @if (\Session::has('danger'))
                <div class="message-alert danger">
                    <i class="fas fa-times-circle"></i>
                    <p> {!! \Session::get('danger') !!}</p>
                </div>
            @endif
            <div id="fb-root"></div>
            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v11.0"
                        nonce="tGIyRgh0">
            </script>
            <a class="mx-auto" target="_blank"
                href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fbalancetonmatch.com/%2Fmatches%2F{{ $match->id }}&amp;src=sdkpreparse"
                class="fb-xfbml-parse-ignore">
                <div class="fixed top-18 left-6 z-50 rounded-full bg-blue-600 text-white">
                    <div data-href="{{ route('matches.show', [$match, Str::slug($match->slug, '-')]) }}"
                        data-layout="button" data-size="large">
                        <div class="flex justify-center items-center">
                            <i class="fab fa-facebook text-2xl text-white"></i>
                            <p class="font-sans text-xs text-center mx-1">Partager</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>


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

    @include('footer')

    @livewireScripts
    @auth
        <script>
            window.User = {
                id: {{ optional(auth()->user())->id }}
            }
        </script>
    @endauth

    <script src="{{ mix('js/app.js') }}?ver=1.03"></script>

</body>


</html>
