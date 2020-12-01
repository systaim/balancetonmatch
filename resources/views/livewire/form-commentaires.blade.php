<form class="min-h-screen" wire:submit.prevent="saveComment">
    <!-- affichage bannière du match -->
    <div>
        <div class="backMatch">
            <div class=" py-6 ">
                <div class="bg-primary text-white m-auto text-center rounded-lg shadow-2xl p-2 max-w-md">
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
            <div class="grid grid-cols-12 pb-10 lg:mx-2 xl:mx-6">
                <div class="col-span-5 overflow-hidden">
                    <div class="bg-primary p-2 text-secondary flex flex-col lg:flex-row lg:items-center lg:rounded-l-full">
                        <div class="flex justify-center">
                            @auth
                            @foreach($commentators as $commentator)
                            @if(($match->live == 'debut' || $match->live == 'repriseMT') && $commentator->user->id == Auth::user()->id)
                            <input class="hidden" type="radio" wire:model="team_action" id="homeAction" name="team_action" value="home">
                            @endif
                            @endforeach
                            @endauth
                            <label for="homeAction">
                                <div class="logo h-16 w-16 sm:h-20 sm:w-20 lg:h-24 lg:w-24 cursor-pointer lg:mr-1 xl:mr-4">
                                    <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->homeClub->numAffiliation }}.jpg" alt="logo">
                                </div>
                            </label>
                        </div>
                        <div>
                            <a href="{{ route('clubs.show', $match->homeClub->id) }}">
                                <p class="truncate text-center sm:font-bold lg:text-lg xl:text-2xl">{{ $match->homeClub->name }}</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="relative col-span-2 bg-gradient-to-r from-primary to-secondary flex flex-col justify-center items-center">
                    <div class="absolute top-1 text-white font-bold text-xl">
                        @if($match->live != 'attente' && $match->live != 'finDeMatch' && $match->live != 'reporte')
                        <p wire:poll.60s.keep-alive="chrono">{{ $minute }}'</p>
                        @endif
                    </div>
                    <div class="flex justify-center mt-2">
                        <div class="bg-white rounded-sm mr-1 z-10">
                            <p class="flex justify-center w-4 text-3xl px-4 font-bold">{{$home_score}}</p>
                        </div>
                        <div class="bg-white rounded-sm ml-1 z-10">
                            <p class="flex justify-center w-4 text-3xl px-4 font-bold">{{$away_score}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-5 overflow-hidden z-0">
                    <div class="bg-secondary p-2 text-primary flex flex-col-reverse lg:flex-row lg:items-center lg:justify-end lg:rounded-r-full">
                        <div>
                            <a href="{{ route('clubs.show', $match->awayClub->id) }}">
                                <p class="truncate text-center lg:text-left sm:font-bold lg:text-lg  xl:text-2xl">{{ $match->awayClub->name }}</p>
                            </a>
                        </div>
                        <div class="flex justify-center">
                            @auth
                            @foreach($commentators as $commentator)
                            @if(($match->live == 'debut' || $match->live == 'repriseMT') && $commentator->user_id == Auth::user()->id)
                            <input class="hidden" type="radio" wire:model="team_action" id="awayAction" name="team_action" value="away">
                            @endif
                            @endforeach
                            @endauth
                            <label for="awayAction">
                                <div class="logo h-16 w-16 sm:h-20 sm:w-20 lg:h-24 lg:w-24 cursor-pointer lg:ml-1 xl:ml-4">
                                    <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->awayClub->numAffiliation }}.jpg" alt="logo">
                                </div>
                            </label>
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

    <div class="fixed openComment flex flex-col justify-center z-10 rounded-b-lg espaceCom {{ $team_action}}">
        <div class="flex flex-col items-center pt-10">
            <h3 class="text-xl text-center px-2 text-primary bg-white rounded-lg">Menu action de match</h3>
            @if($team_action == "home")
            <div class="logo h-24 w-24 cursor-pointer m-4">
                <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->homeClub->numAffiliation }}.jpg" alt="logo">
            </div>
            @endif
            @if($team_action == "away")
            <div class="logo h-24 w-24 cursor-pointer m-4">
                <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->awayClub->numAffiliation }}.jpg" alt="logo">
            </div>
            @endif
            <div class="actionsMatch">
                <input class="hidden" type="radio" id="but" wire:model="type_comments" name="type_comments" value="but">
                <label class="inputAction {{ $team_action }}" for="but">
                    But !
                </label>
                @if($type_comments == "but")
                <div class="p-6 border-2 border-{{ $team_action }} rounded-b-lg shadow-2xl">
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
                    </div>
                </div>
                @endif
                <input class="hidden" type="radio" id="carton" wire:model="type_comments" name="type_comments" value="carton">
                <label class="inputAction {{ $team_action }}" for="carton">
                    Carton !
                </label>
                @if($type_comments == 'carton')
                <div class="p-6 border-2 border-{{ $team_action }} rounded-b-lg">
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
                @endif
            </div>
            @if($team_action == 'home')
            <select class="inputForm focus:outline-none focus:shadow-outline my-1" name="player" id="player" wire:model="player" required>
                <option value="">Choisissez un joueur</option>
                @foreach($match->homeClub->players as $player)
                <option value="{{ $player->id}}">{{$player->first_name}} {{$player->last_name}}</option>
                @endforeach
                @for($i = 1 ; $i <= 16; $i++) <option value="{{ $i }}">Numéro {{$i}}</option>
                    @endfor
            </select>
            <div class="flex items-center text-white m-auto my-4">
                <div class="hidden p-4" wire:loading wire:target="file">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
                <input type="file" wire:model="file" name="file" id="file" accept="jpeg,png,jpg,gif,svg,mov,mp4,m4v">
                @error('file')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="m-4 flex flex-row justify-center">
                <div class="flex flex-col jsutify-center">
                    <label class="inputAction {{$team_action}}" for="minute">Temps de jeu</label>
                    <input wire:poll.60s.keep-alive="chrono" class="p-3 bg-white rounded shadow outline-none focus:outline-none focus:shadow-outline text-center" type="number" name="minute" wire:model="minute" min="1" max="90">
                    @error('minute')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mt-6 flex flex-col justify-center">
                @if (session()->has('messageDebutDeMatch'))
                <div wire:loading.class.remove="alertComment" class="m-auto w-11/12 my-1 flex justify-center items-center text-white p-2 rounded-lg alertComment">
                    {{ session('messageDebutDeMatch') }}
                </div>
                @endif
                <button wire:loading.attr="disabled" wire:loading.class.remove="btnPrimary" wire:target="file" class="btn btnPrimary" type="submit">Je commente</button>
                <input class="hidden" type="radio" id="exit" wire:model="team_action" name="team_action" value="">
                <label for="exit" class="btn btnPrimary text-center">Retour</label>
            </div>
            @endif
            @if($team_action == 'away')
            <select class="inputForm focus:outline-none focus:shadow-outline my-1" name="player" id="player" wire:model="player" required>
                <option value="">Choisissez un joueur</option>
                @foreach($match->awayClub->players as $player)
                <option value="{{ $player->id}}">{{$player->first_name}} {{$player->last_name}}</option>
                @endforeach
                @for($i = 1 ; $i <= 16; $i++) <option value="{{ $i }}">Numéro {{$i}}</option>
                    @endfor
            </select>
            <div class="flex items-center text-white m-auto my-4">
                <input type="file" wire:model="file" name="file" id="file" accept="jpeg,png,jpg,gif,svg,mov,mp4,m4v">
                <div class="hidden p-4" wire:loading wire:target="file">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
                @error('file')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="m-4 flex flex-row justify-center">
                <div class="flex flex-col jsutify-center">
                    <label class="inputAction {{$team_action}}" for="minute">Temps de jeu</label>
                    <input wire:poll.60s.keep-alive="chrono" class="p-3 bg-white rounded shadow outline-none focus:outline-none focus:shadow-outline text-center" type="number" name="minute" wire:model="minute" min="1" max="90">
                    @error('minute')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mt-6 flex flex-col justify-center">
                @if (session()->has('messageDebutDeMatch'))
                <div wire:loading.class.remove="alertComment" class="m-auto w-11/12 my-1 flex justify-center items-center text-white p-2 rounded-lg alertComment">
                    {{ session('messageDebutDeMatch') }}
                </div>
                @endif
                <button wire:loading.attr="disabled" wire:loading.class.remove="btnSecondary" wire:target="file" class="btn btnSecondary" type="submit" value="">Je commente</button>
                <input class="hidden" type="radio" id="exit" wire:model="team_action" name="team_action" value="">
                <label for="exit" class="btn btnSecondary text-center">Retour</label>
            </div>
            @endif
        </div>
    </div>

    <!-- fin Formulaire d'action équipe -->
    <!-- formulaire de commentaires -->
    @auth
    <div>
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
        <div class="mx-6 my-4 text-right">
            <p class="text-xs cursor-pointer underline" wire:click="needHelp">Besoin d'aide ?</p>
        </div>
    </div>
    @endauth
    <div class="lg:w-6/12 lg:m-auto">
        @if($nbrFavoris > 0 && $match->live == "attente")
        <div class="bg-secondary text-primary rounded-lg relative my-2 flex justify-center m-auto p-1">
            @if($nbrFavoris == 1)
            <p>{{ $nbrFavoris }} personne souhaite un direct LIVE</p>
            @else
            <p>{{ $nbrFavoris }} personnes souhaitent un direct LIVE</p>
            @endif
        </div>
        @endif
        @if (session()->has('successMessage'))
        <div wire:loading.class.remove="alertComment" class="m-auto w-11/12 my-1 flex justify-center items-center text-white p-2 rounded-lg alertComment">
            {{ session('successMessage') }}
        </div>
        @endif
        @if($match->live == "finDeMatch" && now()->diffInMinutes($match->date_match) >= 100)
        <div class="m-auto w-11/12 flex justify-center items-center bg-primary text-white p-2 rounded-lg my-6">
            <p>Les commentaires sont cloturés... A bientôt !</p>
        </div>
        @endif
        @if($match->live == 'reporte')
        <div class="w-full h-full py-3 bg-red-600 font-bold rounded-lg shadow-lg my-6">
            <p class="text-center">Le match est reporté à une date ultérieure</p>
        </div>
        @endif
        @if($match->live == 'attente')
        <div class="w-full h-full py-3 bg-primary text-secondary font-bold rounded-lg shadow-lg my-6">
            <p class="text-center">En attente d'un commentateur</p>
        </div>
        @auth
        <button type="button" class="relative commentaires h-20 bg-white commandeMatch items-stretch w-full focus:outline-none minHeight16" wire:click="timeZero" wire:model="type_comments">
            <div class="minuteCommentaires w-24 commandeMatch">
                <img src="{{asset('images/whistle-white.png')}}" alt="">
            </div>
            <div class="bg-white w-full h-full p-3 flex flex-col justify-center">
                <p class="text-center">Je souhaite commenter ⏱</p>
                <div>
                    @if (session()->has('messageComment'))
                    <div wire:loading.class.remove="alertFavori" class="flex items-center absolute top-0 right-0 bottom-0 left-0 bg-black text-white text-xs p-2 rounded-l-lg alertFavori">
                        {{ session('messageComment') }}
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
        @else
        <a href="/login">
            <div class="relative commentaires h-20 bg-white commandeMatch items-stretch w-full focus:outline-none">
                <div class="minuteCommentaires w-24 commandeMatch">
                    <img src="{{asset('images/login.png')}}" alt="">
                </div>
                <div class="bg-white w-full h-full p-3 flex flex-col justify-center">
                    <p class="text-center">Je me connecte</p>
                </div>
            </div>
        </a>
        @endauth
        @endif
        @auth
    </div>
    <div class="my-6 w-11/12 m-auto lg:w-8/12">
        @foreach($commentators as $commentator)
        @if($commentator->user_id == Auth::user()->id)
        @if($match->live == 'debut' && now()->diffInMinutes($match->date_match) >= 40)
        <button type="button" class="commentaires h-12 bg-white commandeMatch items-stretch w-full" wire:click="timeMitemps" wire:model="type_comments">
            <div class="minuteCommentaires w-24 sm:w-32 commandeMatch flex justify-center">
                <img class="bg-contain h-12" src="{{asset('images/whistle-white.png')}}" alt="">
            </div>
            <div class="bg-white w-full pt-3">
                <p class="text-center">Valider la mi-temps</p>
            </div>
        </button>
        @endif
        @if($match->live == 'mitemps')
        <button type="button" class="commentaires h-12 bg-white commandeMatch items-stretch w-full" wire:click="timeReprise" wire:model="type_comments">
            <div class="minuteCommentaires w-24 sm:w-32 commandeMatch flex justify-center">
                <img class="bg-contain h-12" src="{{asset('images/whistle-white.png')}}" alt="">
            </div>
            <div class="bg-white w-full pt-3">
                <p class="text-center">Valider la reprise</p>
            </div>
        </button>
        @endif
        @if($match->live == 'repriseMT' && now()->diffInMinutes($match->date_match) >= 95)
        <button type="button" class="commentaires h-12 bg-white commandeMatch items-stretch w-full" wire:click="timeFinDuMatch" wire:model="type_comments">
            <div class="minuteCommentaires w-24 sm:w-32 commandeMatch flex justify-center">
                <img class="bg-contain h-12" src="{{asset('images/whistle-white.png')}}" alt="">
            </div>
            <div class="bg-white w-full pt-3">
                <p class="text-center">Coup de sifflet final ! ⏱</p>
            </div>
        </button>
        @endif
        @endif
        @endforeach
        @endauth
    </div>
    <!-- fin de formulaire de commentaires -->
    <div class="my-6 w-11/12 m-auto lg:w-11/12 lg:flex lg:justify-around" wire:poll.5000ms.keep-alive="miseAJourCom">
        <div class="lg:w-8/12">
            @foreach($commentsMatch as $comment)
            <div class="relative commentaires minHeight16 h-auto {{ $comment->team_action }}">
                <div class="minuteCommentaires w-24 sm:w-32 {{ $comment->team_action }} p-4 flex flex-col items-center">
                    <div>
                        <p class="text-lg mb-4">{{ $comment->minute}}'</p>
                        @dump($comment->id)
                    </div>
                    @if($comment->team_action == "home")
                    <div class="logo h-8 w-8 cursor-pointer">
                        <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->homeClub->numAffiliation }}.jpg" alt="logo">
                    </div>
                    @endif
                    @if($comment->team_action == "away")
                    <div class="logo h-8 w-8 cursor-pointer">
                        <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->awayClub->numAffiliation }}.jpg" alt="logo">
                    </div>
                    @endif
                </div>
                <div class="relative bg-white w-full p-4 flex flex-col sm:flex-row justify-between">
                    <div class="mb-4">
                        <p class="text-lg font-bold">{{ $comment->type_comments}}</p>
                        <p>{{ $comment->comments }}</p>
                        @if($comment->team_action == "away" || $comment->team_action == "home")
                        <p class="font-bold">{{ $comment->statistic->player->first_name}} {{ $comment->statistic->player->last_name}}</p>
                        @endif
                    </div>
                    @if($comment->images != null)
                    <div class="m-auto sm:mr-6">
                        <a href="{{ asset($comment->images)}}">
                            <img class="max-h-28 rounded-md shadow-xl" src="{{ asset($comment->images)}}" alt="">
                        </a>
                    </div>
                    @endif
                </div>
                @auth
                @foreach($commentators as $commentator)
                @if($commentator->user_id == Auth::user()->id)
                <div class="absolute right-4 bottom-4">
                    <ul class="flex flex-row justify-center">
                        <li class="mr-2 px-2 rounded-lg border-2 border-primary">✎</li>
                        
                        <li class="mr-2 px-2 rounded-lg border-2 border-primary cursor-pointer" wire:click="deleteMenu">🗑</li>
                    </ul>
                </div>
                @endif
                @endforeach
                @endauth
            </div>
            @endforeach
            @if($deleteMenu == 1)
            <div>
                <div class="fixed z-50 bg-gray-200 inset-0 flex justify-center items-center">
                    <div class="p-10 bg-white w-1/2 rounded-lg shadow-xl">
                        <div class=" text-darkGray mb-6">
                            <p>Voulez vous vraiment supprimer ce commentaire ?</p>
                        </div>
                        <div class="flex justify-end">
                        <a href="{{route('supprimer', ['id' => $comment->id]) }}">Supprimer</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div>
            @foreach($commentators as $commentator)
            <div class="bg-white rounded-lg border-white w-11/12 m-auto my-8 shadow-2xl lg:my-0 lg:w-auto max-w-sm">
                <div class="bg-primary text-secondary rounded-t-lg">
                    <h3 class="text-center p-2">Le "Thierry Roland" du jour</h3>
                </div>
                <div class="flex justify-evenly items-center p-4">
                    <div>
                        <p class="font-bold">{{$commentator->user->pseudo}}</p>
                    </div>
                    <!-- <div class="flex items-center justify-center bg-secondary h-12 w-12 rounded-full m-2">
                    @foreach($commentators as $commentator)
                    <p>{{$commentator->user->note}}</p>
                    @endforeach
                </div> -->
                </div>
            </div>
            @endforeach
        </div>

    </div>
</form>