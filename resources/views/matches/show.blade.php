<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- meta Facebook -->
    <meta property="og:url" content="{{ request()->url() }}" />
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
            <meta property="og:image:url" content="{{ asset('images/logos/btmLogo.jpg') }}" />
    @endif
    @if ($match->live == 'attente')
        <meta property="og:image:url" content="{{ asset('images/logos/vs-primary.png') }}" />
    @endif
    <!-- Meta du site -->
    <title>Balance ton match ! {{ $match->homeclub->name }}
        {{ $match->home_score == null ? ' VS ' : $match->home_score . ' - ' . $match->away_score }}
        {{ $match->awayclub->name }}</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}?ver=1.02">
    <link rel="stylesheet" href="{{ mix('css/styles.css') }}?ver=1.02" />
    <script src="https://kit.fontawesome.com/c03c2336c3.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7237777700901740"
        crossorigin="anonymous"></script>


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
</head>

<body>
    <div id="container">
        <header id="header" class="hidden lg:block relative bg-gray-100 h-24 xl:h-auto">
            <div id="burger"
                class="hidden absolute cursor-pointer top-5 left-3 justify-center items-center h-12 w-12 bg-primary z-50">
                <div class="open-main-nav flex justify-center">
                    <span class="burger"></span>
                </div>
            </div>
            <div
                class="relative text-primary flex xl:flex-col justify-center xl:justify-between items-center xl:items-between h-24 xl:block xl:h-auto">
                <div class="relative">
                    <div class="flex justify-center items-center mx-8">
                        <div>
                            <a href="/">
                                <img class="w-20 md:w-24" src="{{ asset('/images/logos/btmLogoJB.png') }}"
                                    alt="logo de BTM">
                            </a>
                        </div>
                        <div class="relative h-auto diagonale">
                            <a href="/">
                                <h1 class="sm:text-2xl md:text-3xl">Balance Ton Match</h1>
                                <p
                                    class="float-right inline-block text-xs60 sm:text-xs md:text-base px-2 bg-primary rounded-md text-white ">
                                    Quand la touche part en live...
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @include('menu')
        </header>
        @if (\Session::has('success'))
            <div class="message-alert success" x-show.transition="open">
                <i class="fas fa-check-circle text-5xl text-white rounded-full shadow-xl m-4"></i>
                <p> {!! \Session::get('success') !!}</p>
            </div>
        @endif
        @if (\Session::has('warning'))
            <div class="message-alert warning">
                <i class="fas fa-exclamation-circle text-5xl text-white rounded-full shadow-xl m-4"></i>
                <p> {!! \Session::get('warning') !!}</p>
            </div>
        @endif
        @if (\Session::has('danger'))
            <div class="message-alert danger">
                <i class="fas fa-times-circle text-5xl text-white rounded-full shadow-xl m-4"></i>
                <p> {!! \Session::get('danger') !!}</p>
            </div>
        @endif




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
        ])

        @include('footer')

        <script src="{{ mix('js/app.js') }}?ver=1.02"></script>

        @livewireScripts

</body>


</html>
