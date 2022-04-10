<div class="absolute inset-0 overflow-hidden" @click="open_menu = false">
    <div x-show="open_menu" x-transition:enter="ease-in-out duration-500" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-500"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        x-description="Background overlay, show/hide based on slide-over state."
        class="absolute inset-0 bg-opacity-75 transition-opacity" @click="open_menu = false" aria-hidden="true">
    </div>
    <div class="fixed inset-0 bg-primary bg-opacity-40 z-50" x-show="open_menu"
        x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
        x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"></div>
    <div class="fixed inset-y-0 right-0 pl-10 max-w-full flex z-50">

        <div x-show="open_menu" style="display: none"
            x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
            x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
            x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" class="w-screen max-w-md"
            x-description="Slide-over panel, show/hide based on slide-over state.">
            <div class="h-full flex flex-col py-6 bg-white shadow-xl overflow-y-scroll">
                <div class="px-4 sm:px-6">
                    <div class="flex items-start justify-between">
                        <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">
                            Menu Principal
                        </h2>
                        <div class="ml-3 h-7 flex items-center">
                            <button type="button"
                                class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                @click="open_menu = false">
                                <span class="sr-only">Close panel</span>
                                <svg class="h-6 w-6" x-description="Heroicon name: outline/x"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="mt-6 relative flex-1 flex flex-col justify-between">
                    <!-- Replace with your content -->
                    <div class="">
                        <ul>
                            <a href="/">
                            <li class="flex items-center mb-2 py-2 w-full px-6 shadow-lg hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                </svg>
                                {{-- <a href="{{ route('home') }}"> --}}
                                    Accueil
                                </li>
                            </a>
                            <a href="{{ route('clubs.index') }}">
                            <li class="flex items-center mb-2 py-2 w-full px-6 shadow-lg hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                </svg>
                                    Rechercher un club
                                </li>
                            </a>
                            <a href="{{ route('competitions.index') }}">
                            <li class="flex items-center mb-2 py-2 w-full px-6 shadow-lg hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                </svg>
                                    Liste des competitions
                                </li>
                            </a>
                            <a href="/contact">
                            <li class="flex items-center mb-2 py-2 w-full px-6 shadow-lg hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                </svg>
                                {{-- <a href="{{ route('contact') }}"> --}}
                                    Contact
                                </li>
                            </a>
                        </ul>
                    </div>
                    <div class="bg-gray-100 p-4">
                        @auth
                            <div>
                                <a class="px-4 block" href="/user/profile">Mon profil</a>
                                @if (Auth::check() && Auth::user()->club)
                                    <a class="px-4 block" href="/clubs/{{ Auth::user()->club->id }}"><span
                                            class="text-sm">Mon
                                            club</span><br>{{ Auth::user()->club->name }}</a>
                                @endif
                                <a class="px-4 block" href="{{ route('matches.create') }}">
                                    Je crée un match
                                </a>
                                @canany(['isSuperAdmin', 'isAdmin'])
                                    <a class="px-4 block" href="/admin">
                                        Page admin
                                    </a>
                                @endcanany
                                <a class="px-4 block" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                            </div>
                        @else
                            <div class="flex justify-evenly items-center p-4">
                                <a class="text-primary" href="/login">Se connecter</a>
                                <a href="/register">
                                    <button class="btn btnPrimary">S'enregistrer</button>
                                </a>
                            </div>
                        @endauth
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
