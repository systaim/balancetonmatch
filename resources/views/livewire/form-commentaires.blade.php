<form wire:submit.prevent="saveComment">
    <!-- affichage bannière du match -->
    <div>
        <div class="backMatch">
            <div class=" py-6 ">
                <div class="bg-primary text-white m-auto text-center rounded-lg shadow-2xl w-3/4 p-2">
                    @if($match->region)
                    <h2>{{ $match->region->name }}</h2>
                    @endif
                    <h3 class="text-sm">{{ $match->competition->name }}</h3>
                    <div class="flex flex-row justify-center">
                        @if($match->divisionRegion)
                        <p class="text-xs mr-1">{{ $match->divisionRegion->name }}</p>
                        @endif
                        @if($match->divisionDepartment)
                        <p class="text-xs mr-1">{{ $match->divisionDepartment->name }}</p>
                        @endif
                        @if($match->group)
                        <p class="text-xs ml-1">{{$match->group->name}}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-12 pb-10">
                <div class="col-span-5 overflow-hidden">
                    <div class="bg-primary p-2 text-secondary flex flex-col">
                        <div class="flex justify-center">
                            @auth
                            @foreach($commentators as $commentator)
                            @if(($match->live == 'debut' || $match->live == 'repriseMT') && $commentator->user->id == Auth::user()->id)
                            <input class="hidden" type="radio" wire:model="team_action" id="homeAction" name="team_action" value="home">
                            @endif
                            @endforeach
                            @endauth
                            <label for="homeAction">
                                <div class="logo h-20 w-20 cursor-pointer">
                                    <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->homeClub->numAffiliation }}.jpg" alt="logo">
                                </div>
                            </label>
                        </div>
                        <div>
                            <a href="{{ route('clubs.show', $match->homeClub->id) }}">
                                <p class="truncate text-center">{{ $match->homeClub->name }}</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-span-2 bg-gradient-to-r from-primary to-secondary flex flex-col justify-center items-center">
                    <div class="flex justify-center">
                        <div class="bg-white rounded-sm mr-1">
                            <p class="flex justify-center w-4 text-3xl px-4 font-bold">{{$home_score}}</p>
                        </div>
                        <div class="bg-white rounded-sm ml-1 z-10">
                            <p class="flex justify-center w-4 text-3xl px-4 font-bold">{{$away_score}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-5 overflow-hidden z-0">
                    <div class="bg-secondary p-2 text-primary flex flex-col">
                        <div class="flex justify-center">
                            @auth
                            @foreach($commentators as $commentator)
                            @if(($match->live == 'debut' || $match->live == 'repriseMT') && $commentator->user_id == Auth::user()->id)
                            <input class="hidden" type="radio" wire:model="team_action" id="awayAction" name="team_action" value="away">
                            @endif
                            @endforeach
                            @endauth
                            <label for="awayAction">
                                <div class="logo h-20 w-20 cursor-pointer">
                                    <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->awayClub->numAffiliation }}.jpg" alt="logo">
                                </div>
                            </label>
                        </div>
                        <div>
                            <a href="{{ route('clubs.show', $match->awayClub->id) }}">
                                <p class="truncate text-center">{{ $match->awayClub->name }}</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="text-center flex justify-center font-bold">
                    <p class="px-4 bg-primary text-secondary rounded-tl-md">{{ $match->date_match->formatLocalized('%d/%m/%y')}}</p>
                    <p class="px-4 bg-primary text-secondary rounded-tr-md">{{ $match->date_match->formatLocalized('%H:%M') }}</p>
                </div>
            </div>
        </div>
    </div>
    <!-- fin affichage bannière du match -->

    <!-- Formulaire d'action équipe -->
    @if($team_action == 'home' || $team_action == 'away')
    <div id="menuTeam" class="flex flex-col justify-center z-10 rounded-b-lg absolute h-auto top-0 right-0 left-0 espaceCom {{ $team_action}}">
        <div class="flex flex-col items-center">
            <div class="m-4 flex flex-row justify-center">
                <div class="flex flex-col jsutify-center">
                    <label class="inputAction {{$team_action}}" for="minute">Temps de jeu</label>
                    <input wire:poll.60000ms.keep-alive="chrono" class="p-3 bg-white rounded shadow outline-none focus:outline-none focus:shadow-outline text-center" type="number" name="minute" wire:model="minute" min="1" max="90">
                </div>
            </div>
            <div class="actionsMatch">
                <input class="hidden" type="radio" id="but" wire:model="type_comments" name="type_comments" value="but">
                <label class="inputAction {{ $team_action }}" for="but">
                    But !
                </label>
                @if($type_comments == "but")
                <div class="p-6 border-2 border-{{ $team_action }}">
                    <div class="flex flex-col">
                        <div>
                            <input class="hidden" type="radio" id="butCF" wire:model="type_but" name="type_but" value="But sur coup-franc">
                            <label class="inputAction {{ $team_action }}" for="butCF">But sur coup-franc</label>
                        </div>
                        <div>
                            <input class="hidden" type="radio" id="butCorner" wire:model="type_but" name="type_but" value="But sur corner">
                            <label class="inputAction {{ $team_action }}" for="butCorner">But sur corner</label>
                        </div>
                        <div>
                            <input class="hidden" type="radio" id="ext-surface" wire:model="type_but" name="type_but" value="Frappe de l'extérieur de la suface">
                            <label class="inputAction {{ $team_action }}" for="ext-surface">Frappe de l'extérieur de la suface</label>
                        </div>
                        <div>
                            <input class="hidden" type="radio" id="int-surface" wire:model="type_but" name="type_but" value="Frappe de l'intérieur de la surface">
                            <label class="inputAction {{ $team_action }}" for="int-surface">Frappe de l'intérieur de la surface</label>
                        </div>
                        <div>
                            <input class="hidden" type="radio" id="penalty" wire:model="type_but" name="type_but" value="But sur pénalty">
                            <label class="inputAction {{ $team_action }}" for="penalty">But sur pénalty</label>
                        </div>
                        @error('type_but')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                @endif
                <input class="hidden" type="radio" id="carton" wire:model="type_comments" name="type_comments" value="carton">
                <label class="inputAction {{ $team_action }}" for="carton">
                    Carton !
                </label>
                @if($type_comments == 'carton')
                <div class="p-6 border-2 border-{{ $team_action }}">
                    <div class="actionsMatch">
                        <input class="hidden" type="radio" id="cartonJaune1" wire:model="type_carton" name="type_comments" value="Carton jaune">
                        <label class="inputAction {{ $team_action }}" for="cartonJaune1">1er carton jaune</label>
                    </div>
                    <div class="actionsMatch">
                        <input class="hidden" type="radio" id="cartonJaune2" wire:model="type_carton" name="type_comments" value="2e carton jaune">
                        <label class="inputAction {{ $team_action }}" for="cartonJaune2">2e carton jaune</label>
                    </div>
                    <div class="actionsMatch">
                        <input class="hidden" type="radio" id="cartonRouge" wire:model="type_carton" name="type_comments" value="Carton rouge">
                        <label class="inputAction {{ $team_action }}" for="cartonRouge">Carton rouge !</label>
                    </div>
                </div>
                @error('type_comments')
                <span class="error">{{ $message }}</span>
                @enderror
                @endif
            </div>
            @if($team_action == 'home')
            <select class="inputForm focus:outline-none focus:shadow-outline my-1" name="player" id="player" wire:model="player">
                <option value="">Choisissez un joueur</option>
                @foreach($match->homeClub->players as $player)
                <option value="{{ $player->id}}">{{$player->first_name}} {{$player->name}}</option>
                @endforeach
            </select>
            <div class="mt-6 flex flex-col justify-center">
                <button class="btn btnPrimary" type="submit" value="">Je commente</button>
                <input class="hidden" type="radio" id="exit" wire:model="team_action" name="team_action" value="">
                <label for="exit" class="btn btnPrimary text-center">Retour</label>
            </div>
            @endif
            @if($team_action == 'away')
            <select class="inputForm focus:outline-none focus:shadow-outline my-1" name="player" id="player" wire:model="player">
                <option value="">Choisissez un joueur</option>
                @foreach($match->awayClub->players as $player)
                <option value="{{ $player->id}}">{{$player->first_name}} {{$player->name}}</option>
                @endforeach
            </select>
            <div class="mt-6 flex flex-col justify-center">
                <button class="btn btnSecondary" type="submit" value="">Je commente</button>
                <input class="hidden" type="radio" id="exit" wire:model="team_action" name="team_action" value="">
                <label for="exit" class="btn btnSecondary text-center">Retour</label>
            </div>
            @endif
        </div>
        @endif
    </div>

    <!-- fin Formulaire d'action équipe -->
    <!-- formulaire de commentaires -->
    @if (session()->has('messageComment'))
    <div wire:loading.class.remove="alertComment" class="m-auto w-1/2 my-1 flex justify-center items-center text-white p-2 rounded-lg alertComment">
        {{ session('messageComment') }}
    </div>
    @endif
    <div>
        <div class="my-6 w-11/12 m-auto">
            @if($match->live == 'reporte')
            <div class="w-full h-full py-3 bg-red-600 font-bold rounded-lg shadow-lg">
                <p class="text-center">Le match est reporté à une date ultérieure</p>
            </div>
            @endif
            @if($match->live == 'attente')
            <div class="w-full h-full py-3 bg-primary text-secondary font-bold rounded-lg shadow-lg">
                <p class="text-center">En attente d'un commentateur</p>
            </div>
            @auth
            <button type="button" class="relative commentaires h-20 bg-white commandeMatch items-stretch w-full focus:outline-none" wire:click="timeZero" wire:model="type_comments">
                <div class="minuteCommentaires w-24 commandeMatch">
                    <img src="{{asset('images/whistle-white.png')}}" alt="">
                </div>
                <div class="bg-white w-full h-full p-3 flex flex-col justify-center">
                    <p class="text-center">Je souhaite commenter ⏱</p>
                    <div>
                        @if (session()->has('messageCom'))
                        <div wire:loading.class.remove="alertFavori" class="flex items-center absolute top-0 right-0 bottom-0 left-0 bg-black text-white text-xs p-2 rounded-l-lg alertFavori">
                            {{ session('messageCom') }}
                        </div>
                        @endif
                    </div>
                </div>
            </button>
            <button type="button" class="relative commentaires h-20 bg-white commandeMatch items-stretch w-full focus:outline-none" wire:click="matchReporte">
                <div class="minuteCommentaires w-24 commandeMatch">
                    <img src="{{asset('images/danger.png')}}" alt="">
                </div>
                <div class="bg-white w-full h-full p-3 flex flex-col justify-center">
                    <p class="text-center">Le match est reporté ou annulé</p>
                    <div>
                        @if (session()->has('messageAnnulation'))
                        <div wire:loading.class.remove="alertFavori" class="flex items-center absolute top-0 right-0 bottom-0 left-0 bg-black text-white text-xs p-2 rounded-l-lg alertFavori">
                            {{ session('messageAnnulation') }}
                        </div>
                        @endif
                    </div>
                </div>
            </button>
            @endauth
            @endif

            @auth
            @foreach($commentators as $commentator)
            @if($commentator->user_id == Auth::user()->id)
            @if($match->live == 'debut' && now()->diffInMinutes($match->date_match) >= 40))
            <button type="button" class="commentaires h-12 bg-white commandeMatch items-stretch w-full" wire:click="timeMitemps" wire:model="type_comments">
                <div class="minuteCommentaires w-24 sm:w-32 commandeMatch">
                    <img src="{{asset('images/whistle-white.png')}}" alt="">
                </div>
                <div class="bg-white w-full pt-3">
                    <p class="text-center">Valider la mi-temps</p>
                </div>
            </button>
            @endif
            @if($firstCom == 1)
            <div class="bg-primary w-full h-96 rounded-lg p-4 text-white text-xs text-center">
                <h3 class="text-secondary text-center text-base mb-4">Comment bien commenter ?</h3>
                <p>Envie de commenter ? Rien de plus simple !</p>
                <p>Il te suffit de cliquer sur un des deux logo pour afficher le menu ACTIONS</p>
                <p>Le temps est donné à titre indicatif, le chrono démarre à l'heure du match. Tu peux le modifier facilement
                    si besoin. Tu choisis une action, un joueur et tu valides.</p>
                <p>C'est tout !</p>
                <button class="btn btnSecondary" wire:click="clickFirstCom" wire:model="firstCom">J'ai compris</button>
            </div>
            @endif
            @if($match->live == 'mitemps')
            <button type="button" class="commentaires h-12 bg-white commandeMatch items-stretch w-full" wire:click="timeReprise" wire:model="type_comments">
                <div class="minuteCommentaires w-24 sm:w-32 commandeMatch">
                    <img src="{{asset('images/whistle-white.png')}}" alt="">
                </div>
                <div class="bg-white w-full pt-3">
                    <p class="text-center">Valider la reprise</p>
                </div>
            </button>
            @endif
            @if($match->live == 'repriseMT')
            <button type="button" class="commentaires h-12 bg-white commandeMatch items-stretch w-full" wire:click="timeFinDuMatch" wire:model="type_comments">
                <div class="minuteCommentaires w-24 sm:w-32 commandeMatch">
                    <img src="{{asset('images/whistle-white.png')}}" alt="">
                </div>
                <div class="bg-white w-full pt-3">
                    <p class="text-center">Coup de sifflet final ! ⏱</p>
                </div>
            </button>
            @endif
            @if($match->live == 'finDeMatch')
            <div class="commentaires h-24 commandeMatch items-stretch w-full">
                <div class="minuteCommentaires w-24 sm:w-32 commandeMatch">
                    <img src="{{asset('images/whistle-white.png')}}" alt="">
                </div>
                <div class="bg-white w-full pt-3">
                    <p class="flex text-center px-4">Les commentaires sont fermés ! Merci</p>
                </div>
            </div>
            @endif
            @endif
            @endforeach
            @endauth
            
            <!-- fin de formulaire de commentaires -->
            <div class="my-4" wire:poll.5000ms="miseAJourCom">
                @foreach($commentsMatch as $comment)
                <div class="relative commentaires minHeight16 h-auto {{ $comment->team_action }}">
                    <div class="minuteCommentaires w-24 sm:w-32 {{ $comment->team_action }}">
                        <p class="text-lg">{{ $comment->minute}}'</p>
                    </div>
                    <div class="relative bg-white w-full px-4 pt-2">
                        <p class="text-lg font-bold">{{ $comment->type_comments}}</p>
                        <p>{{ $comment->comments }}</p>

                    </div>
                    <div class="absolute top-2 right-2 px-3 py-1 cursor-pointer hover:bg-gray-200 rounded-full" wire:click="sousMenu">
                        <div class="h-1 w-1 bg-darkGray rounded-full m-1"></div>
                        <div class="h-1 w-1 bg-darkGray rounded-full m-1"></div>
                        <div class="h-1 w-1 bg-darkGray rounded-full m-1"></div>
                    </div>
                    @if($sousMenu == 1)
                    <div class="absolute top-0 right-0 bottom-0 left-0 bg-gray-200 rounded-lg">
                        <ul class="flex flex-row justify-center text-xs mt-4">
                            <li class="mr-2">Modifier</li>
                            <li class="mr-2">Supprimer</li>
                        </ul>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @if($nbrFavoris > 0)
        <div class="bg-secondary text-primary rounded-lg relative my-2 flex justify-center m-auto p-1 w-11/12">
            @if($nbrFavoris == 1)
            <p>{{ $nbrFavoris }} personne souhaite un direct LIVE</p>
            @else
            <p>{{ $nbrFavoris }} personnes souhaitent un direct LIVE</p>
            @endif
        </div>
        @endif
        <div class="bg-white rounded-lg border-white w-11/12 m-auto my-8 shadow-2xl">
            <div class="bg-primary text-secondary rounded-t-lg">
                <h3 class="text-center py-2">Le "Thierry Roland" du jour</h3>
            </div>
            <div class="flex justify-evenly items-center p-4">
                <div>
                    @foreach($commentators as $commentator)
                    <p class="font-bold">{{$commentator->user->pseudo}}</p>
                    @endforeach
                </div>
                <!-- <div class="flex items-center justify-center bg-secondary h-12 w-12 rounded-full m-2">
                    @foreach($commentators as $commentator)
                    <p>{{$commentator->user->note}}</p>
                    @endforeach
                </div> -->
            </div>
        </div>
    </div>
</form>