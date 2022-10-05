<div class="bg-gray-50 overflow-hidden" wire:init='loadCommentators'>
    <div class="relative max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8">
        <svg class="absolute top-0 left-full transform -translate-x-1/2 -translate-y-3/4 lg:left-auto lg:right-full lg:translate-x-2/3 lg:translate-y-1/4"
            width="404" height="784" fill="none" viewBox="0 0 404 784" aria-hidden="true">
            <defs>
                <pattern id="8b1b5f72-e944-4457-af67-0c6d15a99f38" x="0" y="0" width="20"
                    height="20" patternUnits="userSpaceOnUse">
                    <rect x="0" y="0" width="4" height="4" class="text-gray-200"
                        fill="currentColor" />
                </pattern>
            </defs>
            <rect width="404" height="784" fill="url(#8b1b5f72-e944-4457-af67-0c6d15a99f38)" />
        </svg>

        <div class="relative py-6">
            <h2 class="text-xl tracking-tight text-gray-900 sm:text-4xl">
                Les commentateurs du dimanche
            </h2>
            @if (!$readyToLoad)
                <div class="flex justify-center items-center">
                    <div class="spinner-primary"></div>
                </div>
            @endif
            <div class="mt-10 flex flex-wrap justify-center w-full">
                @if ($commentators)
                    @foreach ($commentators as $com)
                        <div class="relative bg-primary rounded-md shadow-xl overflow-hidden text-white w-72 m-2">
                            <a href="{{ route('matches.show', [$com->match->id]) }}">
                                <div class="absolute -top-3 -left-3 logo h-20 w-20 transform -rotate-12">
                                    <img class="object-contain" src="{{ asset($com->match->homeClub->logo) }}"
                                        alt="Logo de {{ $com->match->homeClub->name }}">
                                </div>
                                <div class="absolute -top-3 -right-3 logo h-20 w-20 transform rotate-12">
                                    <img class="object-contain" src="{{ asset($com->match->awayClub->logo) }}"
                                        alt="Logo de {{ $com->match->awayClub->name }}">
                                </div>
                                <div class="flex justify-center items-start py-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 01-1.44-4.282m3.102.069a18.03 18.03 0 01-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 018.835 2.535M10.34 6.66a23.847 23.847 0 008.835-2.535m0 0A23.74 23.74 0 0018.795 3m.38 1.125a23.91 23.91 0 011.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 001.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 010 3.46" />
                                    </svg>
                                    <p class="text-sm leading-6 font-medium ml-3">
                                        {{ $com->user->pseudo }}
                                    </p>

                                    {{-- <span
                                            class=" flex items-center justify-center h-6 w-6 text-xs bg-orange-600 rounded-full">
                                            {{ $com->merci }}
                                        </span> --}}
                                </div>
                            </a>
                        </div>
                    @endforeach
                    {{-- {{ $commentators->links() }} --}}
                @endif
            </div>
        </div>
    </div>
</div>
