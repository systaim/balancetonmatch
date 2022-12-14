<div class="relative commentaires h-auto flex justify-center {{ $comment->team_action }} my-1 border rounded-md shadow-md" x-data="{ open: false }">
    <div class="rounded-md {{ $comment->team_action }} p-4 flex flex-col items-center"
        @if ($comment->team_action == 'home') style="background-color: {{ $match->homeClub->primary_color }};
        color:{{ $match->homeClub->secondary_color == $match->homeClub->primary_color ? '#cdfb0a' : $match->homeClub->secondary_color }}"
        @elseif ($comment->team_action == 'away')
        style="background-color: {{ $match->awayClub->primary_color }};
        color:{{ $match->awayClub->secondary_color == $match->awayClub->primary_color ? '#cdfb0a' : $match->awayClub->secondary_color }}" @endif>
        @if ($comment->team_action != 'match')
            <div>
                @if ($comment->minute > 90)
                    <p class="mb-4">90<span class="text-xs">+{{ $comment->minute - 90 }}</span>'</p>
                @else
                    <p class="mb-4">{{ $comment->minute }}'</p>
                @endif
            </div>
        @endif
        @if ($comment->team_action == 'home')
            <div class="logo h-8 w-8 cursor-pointer">
                <img class="object-contain" src="{{ asset($match->homeClub->logo) }}"
                    alt="Logo de {{ $match->homeClub->name }}">
            </div>
        @endif
        @if ($comment->team_action == 'away')
            <div class="logo h-8 w-8 cursor-pointer">
                <img class="object-contain" src="{{ asset($match->awayClub->logo) }}"
                    alt="Logo de {{ $match->awayClub->name }}">
            </div>
        @endif
    </div>
    <div class="relative w-full p-2 flex justify-between">
        <div class="text-sm w-full">
            <div {{ $comment->type_comments == 'Pub' ? 'wire:ignore' : '' }}>
                <p>{{ $comment->type_comments }}</p>
                @if ($comment->type_comments == 'Pub')
                    <p>{!! $comment->comments !!}</p>
                @endif
                <div class="flex justify-between">
                    @if ($comment->statistic)
                        @if ($comment->team_action == 'away' || $comment->team_action == 'home')
                            @if ($comment->statistic->player)
                                <div class="relative flex flex-col">
                                    <p>
                                        {{ ucfirst($comment->statistic->player->first_name) }}
                                        {{ ucfirst($comment->statistic->player->last_name) }}
                                    </p>
                                    @if ($comment->statistic->player->id >= 1 && $comment->statistic->player->id <= 16 && $match->id != 0)
                                        <button type="button" class="text-xs px-2 bg-primary text-white rounded-md"
                                            @click="open = true">
                                            Qui est ce ?
                                        </button>
                                    @endif
                                </div>
                            @endif
                        @endif
                    @endif
                    <div class="flex justify-end">
                        @foreach ($comment->reactions->groupBy('emoji') as $type => $reaction)
                            @foreach ($reaction->groupBy('id') as $id => $react)
                                <div class="flex flex-col items-center">
                                    <button
                                        class="border h-10 w-10 m-1 rounded-full shadow-2xl bg-gray-100 flex justify-center items-center"
                                        wire:click="reaction({{ $id }}, {{ $comment->id }})">
                                        <p class="border-orange-400 m-1">{{ $type }}</p>
                                    </button>
                                    <p>{{ count($reaction) }}</p>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Menu ajout d'un joueur par utilisateur -->
            <div class="border-t-2 pt-4 flex flex-col justify-center items-center mt-4" x-show="open"
                @click.away="open = false">
                <h3 class="text-sm">Tu connais ce joueur ?</h3>
                <div class="flex flex-col">
                    @auth
                        <div class="flex justify-center">
                            <select class="focus:outline-none focus:shadow-outline my-1 border-2 m-1 p-1" name="playerMatch"
                                id="playerMatch" wire:model="playerMatch">
                                <option value="">Choisis un joueur</option>
                                @foreach ($comment->team_action == 'home' ? $match->homeClub->players->sortBy('first_name') : $match->awayClub->players->sortBy('first_name') as $player)
                                    <option value="{{ $player->id }}">
                                        {{ ucfirst($player->first_name) }}
                                        {{ ucfirst($player->last_name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="button" class="border rounded-lg py-1 shadow-xl hover:shadow-inner m-2"
                            wire:click="miseAJourJoueur('{{ $comment->team_action }}' ,  {{ $comment->statistic }})">
                            Je valide
                        </button>
                        <div class="flex flex-col justify-center items-center ">
                            <p>Ou</p>
                            <a target="_blank" class="border rounded-lg py-1 shadow-xl hover:shadow-inner m-2 px-2"
                                href="{{ route('clubs.players.index', [$comment->team_action == 'home' ? $match->homeClub->id : $match->awayClub->id]) }}">
                                Je cr??e le joueur ici
                            </a>
                            {{-- <p class="text-sm">Ou cr??e le ici</p>
                            <a href="{{route(players.index, [])}}"></a> --}}
                            {{-- <input
                                {{ $playerMatch != '' && $playerMatch != null ? 'disabled' : '' }}
                                wire:model="playerPrenom" name="playerPrenom"
                                class="{{ $playerMatch != '' && $playerMatch == null ? 'cursor-not-allowed' : '' }} text-primary border-b border-primary focus:outline-none w-2/3 sm:m-1 p-1"
                                type="text" placeholder="pr??nom">
                            <input
                                {{ $playerMatch != '' && $playerMatch != null ? 'disabled' : '' }}
                                wire:model="playerNom" name="playerNom"
                                class="{{ $playerMatch != '' && $playerMatch != null ? 'cursor-not-allowed' : '' }} text-primary border-b border-primary focus:outline-none w-2/3 m-1 p-1"
                                type="text" placeholder="nom"> --}}
                        </div>
                    @else
                        <div class="my-2 text-center">
                            <p class="text-xs">pour pouvoir renseigner ce joueur</p>
                            <a href="/login" class="text-xs px-2 py-1 bg-primary text-secondary">
                                Connecte toi
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
            <!-- FIN menu ajout d'un joueur par utilisateur -->
            {{-- <div>
                @if ($comment->images != null)
                    <div class="flex justify-end pr-8">
                        @if (pathinfo($comment->images)['extension'] == 'mp4' || pathinfo($comment->images)['extension'] == 'mov')
                            <video controls class="max-h-48 w-auto rounded-md shadow-xl">
                                <source src="{{ asset($comment->images) }}" type="video/mp4">
                                <source src="{{ asset($comment->images) }}" type="video/mov">
                                Your browser does not support the video tag.
                            </video>
                        @else
                            <a href="{{ asset($comment->images) }}">
                                <img class="max-h-48 rounded-md shadow-xl" src="{{ asset($comment->images) }}"
                                    alt="action">
                            </a>
                        @endif
                    </div>
                @else
                    @if ($comment->statistic)
                        @if ($comment->statistic->player->id > 16)
                            <div class="flex justify-center md:justify-end my-4">
                                <img class="h-36 rounded-lg" src="{{ $comment->statistic->player->avatar_path }}"
                                    alt="{{ $comment->statistic->player->first_name }} {{ $comment->statistic->player->last_name }}">
                            </div>
                        @endif
                    @endif
                @endif
            </div> --}}
        </div>
    </div>
    @auth
        @if (($match->commentateur->user_id == Auth::user()->id && $match->live != 'finDeMatch') ||
            Auth::user()->role == 'super-admin' ||
            Auth::user()->role == 'admin')
            @if ($comment->type_comments != 'Pub')
                <div class="absolute flex justify-center items-center right-1 top-0">
                    <div>
                        <a class="text-lg text-danger" href="{{ route('supprimer', ['id' => $comment->id]) }}"
                            onclick="return confirm('Etes vous s??r de vouloir supprimer ce commentaire ?')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endif
        @endif
    @endauth
</div>
