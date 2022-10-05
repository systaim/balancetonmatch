<aside class="bg-white rounded-lg m-4 py-4 shadow-white-xl overflow-y-scroll h-96 md:w-1/3">
    <h3 class="px-4">Dernières actus</h3>
    @if (!$readyToLoad)
        <div class="flex justify-center items-center">
            <div class="spinner-primary"></div>
        </div>
    @endif
    <div wire:init='loadActivities'>
        @if ($activities)
            <ul role="list" class="divide-y divide-gray-200">
                @foreach ($activities as $activite)
                    @switch($activite->type)
                        @case('update_score')
                            @if ($activite->match)
                                <a href="{{ route('matches.show', [$activite->match->id]) }}">
                                    <li class="py-4 hover:bg-gray-50 px-4">
                                        <div class="flex space-x-3 ">
                                            <div class="flex-1 space-y-1 ">
                                                <div class="flex items-center justify-between">
                                                    <p class="text-sm font-medium">
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                            Match
                                                        </span>
                                                        par {{ $activite->user->pseudo }}
                                                    </p>
                                                    <p class="text-xs text-gray-500">
                                                        {{ Carbon\Carbon::create($activite->created_at)->diffForHumans() }}
                                                    </p>
                                                </div>
                                                <div class="flex">
                                                    <div>
                                                        <p class="text-sm text-gray-500">
                                                            Le score est mis à jour
                                                        </p>
                                                        <p class="text-sm text-gray-500">
                                                            {{ $activite->match->homeClub->name }} -
                                                            {{ $activite->match->awayClub->name }}
                                                        </p>
                                                    </div>

                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-3 text-gray-500"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </a>
                            @endif
                        @break

                        @case('create_match')
                            @if ($activite->match)
                                <a href="{{ route('matches.show', [$activite->match->id]) }}">
                                    <li class="py-4 hover:bg-gray-50 px-4">
                                        <div class="flex space-x-3 ">
                                            <div class="flex-1 space-y-1 ">
                                                <div class="flex items-center justify-between">
                                                    <p class="text-sm font-medium">
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                            Match
                                                        </span>
                                                        par {{ $activite->user->pseudo }}
                                                    </p>
                                                    <p class="text-xs text-gray-500">
                                                        {{ Carbon\Carbon::create($activite->created_at)->diffForHumans() }}
                                                    </p>
                                                </div>
                                                <div class="flex">
                                                    <div>
                                                        <p class="text-sm text-gray-500">
                                                            Le match est créé
                                                        </p>
                                                        <p class="text-sm text-gray-500">
                                                            {{ $activite->match->homeClub->name }} -
                                                            {{ $activite->match->awayClub->name }}
                                                        </p>
                                                    </div>

                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-3 text-gray-500"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </a>
                            @endif
                        @break

                        @case('create_commentator')
                            @if ($activite->match)
                                <a href="{{ route('matches.show', [$activite->match->id]) }}">
                                    <li class="py-4 hover:bg-gray-50 px-4">
                                        <div class="flex space-x-3 ">
                                            <div class="flex-1 space-y-1 ">
                                                <div class="flex items-center justify-between">
                                                    <p class="text-sm font-medium">
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                            Match
                                                        </span>
                                                        par {{ $activite->user->pseudo }}
                                                    </p>
                                                    <p class="text-xs text-gray-500">
                                                        {{ Carbon\Carbon::create($activite->created_at)->diffForHumans() }}
                                                    </p>
                                                </div>
                                                <div class="flex items-center">
                                                    <p class="text-sm text-gray-500"> commente<br>
                                                        {{ $activite->match->homeClub->name }} -
                                                        {{ $activite->match->awayClub->name }}
                                                    </p>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-3 text-gray-500"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </a>
                            @endif
                        @break

                        @case('update_cover')
                            @if ($activite->club)
                                <a href="{{ route('clubs.show', [$activite->club->id]) }}">
                                    <li class="py-4 hover:bg-gray-50 px-4">
                                        <div class="flex space-x-3 ">
                                            <div class="flex-1 space-y-1 ">
                                                <div class="flex items-center justify-between">
                                                    <p class="text-sm font-medium">
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                            Club
                                                        </span>
                                                        par {{ $activite->user->pseudo }}
                                                    </p>
                                                    <p class="text-xs text-gray-500">
                                                        {{ Carbon\Carbon::create($activite->created_at)->diffForHumans() }}
                                                    </p>
                                                </div>
                                                <div class="flex items-center">
                                                    <p class="text-sm text-gray-500">Couverture mise à jour<br>
                                                        {{ $activite->club->name }}
                                                    </p>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-3 text-gray-500"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </a>
                            @endif
                        @break

                        @case('create_player')
                            @if ($activite->player)
                                <a href="{{ route('clubs.players.show', [$activite->club->id, $activite->player->id]) }}">
                                    <li class="py-4 hover:bg-gray-50 px-4">
                                        <div class="flex space-x-3 ">
                                            <div class="flex-1 space-y-1 ">
                                                <div class="flex items-center justify-between">
                                                    <p class="text-sm font-medium">
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                            Joueur
                                                        </span>
                                                        par {{ $activite->user->pseudo }}
                                                    </p>
                                                    <p class="text-xs text-gray-500">
                                                        {{ Carbon\Carbon::create($activite->created_at)->diffForHumans() }}
                                                    </p>
                                                </div>
                                                <div class="flex items-center">
                                                    <p class="text-sm text-gray-500">Joueur créé<br>
                                                        {{ $activite->player->first_name }}
                                                        {{ $activite->player->last_name }}
                                                    </p>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-3 text-gray-500"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </a>
                            @endif
                        @break

                        @default
                    @endswitch
                @endforeach
            </ul>
            {{-- @if (!empty($activities))
                        <div class="p-4">
                            <p class="text-sm text-gray-500">Aucune actualité récente...</p>
                        </div>
                    @endif --}}
        @endif
    </div>
</aside>
