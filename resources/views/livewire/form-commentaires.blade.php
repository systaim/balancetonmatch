<div {{ $match->live != 'attente' && $match->live != 'finDeMatch' && $match->live != 'reporte' ? "wire:poll.5000ms" : "" }}>
    <form wire:submit.prevent="saveComment">
        <!-- affichage bannière du match -->
        <div class="backMatch">
            <div class="py-6">
                <div class="relative bg-primary text-white m-auto text-center rounded-lg shadow-2xl p-2 max-w-md">
                    @if($match->region && $match->region->id != 20)
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
            <div class="grid grid-cols-12 lg:mx-16 xl:mx-24 mb-2">
                <div class="col-span-5 overflow-hidden">
                    <div class="bg-primary p-2 text-secondary flex flex-col lg:flex-row lg:items-center lg:rounded-l-full">
                        <div class="relative flex justify-center">
                            @auth
                            @if($match->commentateur != null && $match->commentateur->user->id == Auth::user()->id && $match->live != 'attente' && $match->live != 'finDeMatch')
                            <input class="hidden" type="radio" wire:model="team_action" id="homeAction" name="team_action" value="home">
                            @endif
                            @endauth
                            <label for="homeAction">
                                <div class="logo h-16 w-16 sm:h-20 sm:w-20 lg:h-32 lg:w-32 cursor-pointer lg:mr-1 xl:mr-4">
                                    <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->homeClub->numAffiliation }}.jpg" alt="logo">
                                </div>
                            </label>
                        </div>
                        <div>
                            <p class="truncate text-center sm:font-bold lg:text-2xl">
                                {{ $match->homeClub->name }}
                            </p>
                        </div>
                        <!-- <div>
                            <a href="{{ route('clubs.show', $match->homeClub->id) }}">
                                <p class="truncate text-right text-sm">
                                    Vers le club
                                </p>
                            </a>
                        </div> -->
                    </div>

                </div>
                <div class="relative col-span-2 bg-gradient-to-r from-primary to-secondary flex flex-col justify-center items-center">
                    <div class="flex justify-center mt-2">
                        <div class="bg-white rounded-sm mr-1 z-10">
                            <p class="flex justify-center w-4 text-3xl px-4 sm:text-5xl sm:px-6 font-bold">{{$home_score}}</p>
                        </div>
                        <div class="bg-white rounded-sm ml-1 z-10">
                            <p class="flex justify-center w-4 text-3xl px-4 sm:text-5xl sm:px-6 font-bold">{{$away_score}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-5 overflow-hidden z-0">
                    <div class="bg-secondary p-2 text-primary flex flex-col-reverse lg:flex-row lg:items-center lg:justify-end lg:rounded-r-full">
                        <div>
                            <p class="truncate text-center lg:text-left sm:font-bold lg:text-2xl">
                                {{ $match->awayClub->name }}
                            </p>
                        </div>
                        <div class="flex justify-center">
                            @auth
                            @if($match->commentateur != null && $match->commentateur->user_id == Auth::user()->id && $match->live != 'attente' && $match->live != 'finDeMatch')
                            <input class="hidden" type="radio" wire:model="team_action" id="awayAction" name="team_action" value="away">
                            @endif
                            @endauth
                            <label for="awayAction">
                                <div class="logo h-16 w-16 sm:h-20 sm:w-20 lg:h-32 lg:w-32 cursor-pointer lg:ml-1 xl:ml-4">
                                    <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->awayClub->numAffiliation }}.jpg" alt="logo">
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-12">
                <div class="col-span-4">
                    @foreach($commentsMatch->sortBy('minute') as $comment)
                    @if($comment->team_action == "home" && $comment->type_action == "goal")
                    <div class="flex flex-row justify-end items-center m-auto overflow-hidden mx-1">
                        <div class="bg-primary text-secondary font-bold px-2 py-1 flex justify-end items-center w-full sm:w-48 rounded-lg mb-1">
                            <p class="text-xs md:text-sm px-2 truncate">{{ substr($comment->statistic->player->first_name, 0, 1)}}.
                                {{ $comment->statistic->player->last_name}}
                            </p>
                            <p class="text-xs w-8 text-right px-2">{{ $comment->minute }}'</p>
                            <p class="text-xs">⚽</p>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                <div class="col-span-4 flex justify-center">
                    <div class="text-white font-bold text-2xl bg-primary flex justify-center items-center w-20 h-20 my-3 rounded-full border-2 border-secondary">
                        @if($match->live != 'attente' && $match->live != 'finDeMatch' && $match->live != 'reporte')
                        <p>{{ $minute }}'</p>
                        @else
                        <div class="flex flex-col text-sm items-center justify-center">
                            <p>{{ $match->date_match->formatLocalized('%H:%M') }}</p>
                            <p>{{ $match->date_match->formatLocalized('%d/%m/%y')}}</p>
                        </div>

                        @endif
                    </div>
                </div>
                <div class="col-span-4">
                    @foreach($commentsMatch->sortBy('minute') as $comment)
                    @if($comment->team_action == "away" && $comment->type_action == "goal")
                    <div class="flex flex-row justify-start items-center m-auto overflow-hidden mx-1">
                        <div class="bg-secondary text-primary font-bold px-2 py-1 flex flex-row-reverse justify-end items-center w-full sm:w-48 rounded-lg mb-1">
                            <p class="text-xs md:text-sm px-2 truncate">{{ substr($comment->statistic->player->first_name, 0, 1)}}.
                                {{ $comment->statistic->player->last_name}}
                            </p>
                            <p class="text-xs w-8 text-right px-2">{{ $comment->minute }}'</p>
                            <p class="text-xs">⚽</p>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            <div class="flex flex-col items-center justify-center w-full">
                <div class="flex justify-center">
                    @if($match->live != 'reporte' && $match->live != 'attente' && $match->live != 'finDeMatch')
                    <div class="relative uppercase inline-block text-primary font-bold bg-secondary px-2 rounded-sm text-xl">
                        <div class="animate-ping absolute -top-0.5 -right-0.5 bg-red-500 h-3 w-3 rounded-full"></div>
                        LIVE
                    </div>
                    @endif
                </div>
                @if($match->live != 'attente' && $match->live != 'finDeMatch' && $match->live != 'reporte')
                <div class="text-center flex justify-center font-bold">
                    <p class="px-4 bg-primary text-secondary rounded-tl-md">
                        {{ $match->date_match->formatLocalized('%d/%m/%y')}}
                    </p>
                    <p class="px-4 bg-primary text-secondary rounded-tr-md">
                        {{ $match->date_match->formatLocalized('%H:%M') }}
                    </p>
                </div>
                @endif
            </div>
            <div class="bg-primary px-8 py-2 text-secondary flex justify-center">
                <p>Nombre de spectateurs : </p>
                <p class="ml-1 font-bold">{{ count($visitors) }}</p>
            </div>
        </div>
        <!-- fin affichage bannière du match -->

        <!-------------------------
            Formulaire d'action équipe 
            ---------------------------->
        <div class="fixed openComment flex flex-col justify-center z-10 rounded-b-lg espaceCom {{ $team_action}}">
            <div class="flex flex-col items-center pt-10">
                <h3 class="text-xl text-center px-2 text-primary bg-gray-200 rounded-lg">Menu action de match</h3>
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
                    <div class="flex justify-center items-center">
                        <label class="inputAction" for="but">
                            <input class="hidden" type="radio" id="but" wire:model="type_comments" name="type_comments" value="but">
                            <img class="border-2 border-primary rounded-full p-2 shadow-xl w-32" src="{{ asset('images/ball.png') }}" alt="But !">
                        </label>
                        <label class="inputAction" for="carton">
                            <input class="hidden" type="radio" id="carton" wire:model="type_comments" name="type_comments" value="carton">
                            <img class="border-2 border-primary rounded-full p-2 shadow-xl w-32" src="{{ asset('images/cards.png') }}" alt="But !">
                        </label>
                    </div>
                    @if($type_comments == "but")
                    <div class="p-6 border rounded-lg shadow-2xl">
                        <div class="flex flex-col">
                            <div>
                                <input class="hidden" type="radio" id="butCF" wire:model="type_but" name="type_but" value="But sur coup-franc">
                                <label class="inputAction" for="butCF">But sur coup-franc</label>
                            </div>
                            <div>
                                <input class="hidden" type="radio" id="butCorner" wire:model="type_but" name="type_but" value="But sur corner">
                                <label class="inputAction" for="butCorner">But sur corner</label>
                            </div>
                            <div>
                                <input class="hidden" type="radio" id="ext-surface" wire:model="type_but" name="type_but" value="Frappe de l'extérieur de la suface">
                                <label class="inputAction" for="ext-surface">Frappe de l'extérieur de la suface</label>
                            </div>
                            <div>
                                <input class="hidden" type="radio" id="int-surface" wire:model="type_but" name="type_but" value="Frappe de l'intérieur de la surface">
                                <label class="inputAction" for="int-surface">Frappe de l'intérieur de la surface</label>
                            </div>
                            <div>
                                <input class="hidden" type="radio" id="penalty" wire:model="type_but" name="type_but" value="But sur pénalty">
                                <label class="inputAction" for="penalty">But sur pénalty</label>
                            </div>
                            <!-- <div>
                                <input class="hidden" type="radio" id="perso" wire:model="type_but" name="type_but" value="perso">
                                <label class="inputAction" for="perso">Commentaire personnalisé</label>
                            </div>
                            @if($type_but == "perso")
                                <label for="comPerso">
                                    <textarea placeholder="Fais parler ton âme de commentateur ! Lache-toi tout en respectant les acteurs du match. Pas d'insultes, de mots racistes ou de gestes pouvant blesser quiconque. Sois respectueux..." class="p-2 border-2 w-full my-4" name="comPerso" id="comPerso" rows="10"></textarea>
                                </label>
                            @endif -->
                        </div>
                    </div>
                    @endif
                    @if($type_comments == 'carton')
                    <div class="p-6 border rounded-lg shadow-2xl">
                        <div class="actionsMatch">
                            <input class="hidden" type="radio" id="cartonJaune1" wire:model="type_carton" name="type_comments" value="Carton jaune">
                            <label class="inputAction" for="cartonJaune1">1er carton jaune</label>
                        </div>
                        <div class="actionsMatch">
                            <input class="hidden" type="radio" id="cartonJaune2" wire:model="type_carton" name="type_comments" value="2e carton jaune">
                            <label class="inputAction" for="cartonJaune2">2e carton jaune</label>
                        </div>
                        <div class="actionsMatch">
                            <input class="hidden" type="radio" id="cartonRouge" wire:model="type_carton" name="type_comments" value="Carton rouge">
                            <label class="inputAction" for="cartonRouge">Carton rouge !</label>
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
                    <label class="cursor-pointer my-4 btn border border-black text-black" for="file">
                        <div class="flex justify-between">
                            <div class="hidden" wire:loading wire:target="file">
                                <svg class="animate-spin mr-2 h-5 w-5 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </div>
                            <div>
                                <p>Choisir une photo 📷</p>
                            </div>
                        </div>
                        <input class="hidden" type="file" wire:model="file" name="file" id="file" accept="jpeg,png,jpg,gif,svg">
                    </label>
                </div>
                @if ($file)
                <div class="flex flex-col items-center">
                    Aperçu de l'image :
                    <img class="w-36" src="{{ $file->temporaryUrl() }}">
                </div>
                @endif
                @error('file')
                <span class="error">{{ $message }}</span>
                @enderror
                <div class="m-4 flex flex-row justify-center">
                    <div class="flex flex-col jsutify-center">
                        <label class="inputAction {{$team_action}}" for="minuteCom">Temps de jeu</label>
                        <input class="p-3 bg-white rounded shadow outline-none focus:outline-none focus:shadow-outline text-center" type="number" name="minuteCom" wire:model="minuteCom" min="1" max="90">
                        @error('minuteCom')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mt-6 flex flex-col justify-center">
                    <button wire:loading.attr="disabled" wire:loading.class.remove="btnPrimary" wire:target="file" class="btn btnPrimary" type="submit">Je commente</button>
                    <input class="hidden" type="radio" id="exit" wire:model="team_action" name="team_action" value="">
                    <label for="exit" class="btn btnPrimary text-center" wire:click="retour">Retour</label>
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
                    <label class="cursor-pointer my-4 btn border border-black text-black" for="file">
                        <div class="flex justify-between">
                            <div class="hidden" wire:loading wire:target="file">
                                <svg class="animate-spin mr-2 h-5 w-5 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </div>
                            <div>
                                <p>Choisir une photo 📷</p>
                            </div>
                        </div>
                        <input class="hidden" type="file" wire:model="file" name="file" id="file" accept="jpeg,png,jpg,gif,svg">
                    </label>
                </div>
                @if ($file)
                <div class="flex flex-col items-center">
                    Aperçu de l'image :
                    <img class="w-36" src="{{ $file->temporaryUrl() }}">
                </div>
                @endif
                @error('file')
                <span class="error">{{ $message }}</span>
                @enderror
                <div class="m-4 flex flex-row justify-center">
                    <div class="flex flex-col jsutify-center">
                        <label class="inputAction" for="minuteCom">Temps de jeu</label>
                        <input class="p-3 bg-white rounded shadow outline-none focus:outline-none focus:shadow-outline text-center" type="number" name="minuteCom" wire:model="minuteCom" min="1" max="90">
                        @error('minuteCom')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mt-6 flex flex-col justify-center">
                    <button wire:loading.attr="disabled" wire:loading.class.remove="btnSecondary" wire:target="file" class="btn btnSecondary" type="submit" value="">Je commente</button>
                    <input class="hidden" type="radio" id="exit" wire:model="team_action" name="team_action" value="">
                    <label for="exit" class="btn btnSecondary text-center" wire:click="retour">Retour</label>
                </div>
                @endif
            </div>
        </div>

        <!----------------------
            Options commentaires "match"
                ------------------------->
        @auth
        <div>
            @if($firstCom == 1)
            <div class="bg-primary w-11/12 rounded-lg p-4 text-white m-auto my-2">
                <h3 class="text-secondary text-center text-base mb-4">Comment bien commenter ?</h3>
                <div class="flex justify-evenly">
                    <div class="logo h-16 w-16 sm:h-20 sm:w-20 lg:h-24 lg:w-24 cursor-pointer lg:mr-1 xl:mr-4">
                        <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->homeClub->numAffiliation }}.jpg" alt="logo">
                    </div>
                    <div class="logo h-16 w-16 sm:h-20 sm:w-20 lg:h-24 lg:w-24 cursor-pointer lg:mr-1 xl:mr-4">
                        <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->awayClub->numAffiliation }}.jpg" alt="logo">
                    </div>
                </div>
                <div class="my-4 mx-6 flex justify-center">
                    <ol class="list-decimal p-2">
                        <li>Clique sur le logo d'équipe de ton choix</li>
                        <li>Renseigne l'action (but, carton, etc...)</li>
                        <li>Tu peux ajouter une photo de l'exploit si tu veux</li>
                        <li>Valide ! et c'est tout... 😉</li>
                    </ol>
                </div>
                <div class="text-center">
                    <button class="btn btnSecondary" wire:click="clickFirstCom" wire:model="firstCom">J'ai
                        compris</button>
                </div>
            </div>
            @endif
        </div>
        @endauth
        <div class="mx-auto sm:w-11/12 md:w-9/12">
            @if($nbrFavoris > 0 && $match->live == "attente")
            <div class="bg-secondary text-primary rounded-lg relative my-2 flex justify-center m-auto p-1">
                @if($nbrFavoris == 1)
                <p>{{ $nbrFavoris }} personne souhaite un direct LIVE</p>
                @else
                <p>{{ $nbrFavoris }} personnes souhaitent un direct LIVE</p>
                @endif
            </div>
            @endif
            @if($match->live == 'reporte')
            <div class="flex justify-center items-center my-6">
                <p class="bg-danger font-bold rounded-md py-2 px-3">Le match est reporté à une date ultérieure</p>
            </div>
            @endif
            @if(empty($match->commentateur) && $match->live != "finDeMatch")
            <div class="flex justify-center items-center my-6">
                <p class="bg-primary text-white rounded-md py-2 px-3">En attente d'un commentateur</p>
            </div>
            @auth
            <button type="button" class="relative commentaires h-24 bg-white commandeMatch items-stretch w-full focus:outline-none minHeight16" wire:click="becomeCommentator" wire:model="commentator">
                <div class="minuteCommentaires w-24 commandeMatch flex flex-col justify-center items-center">
                    <img src="{{asset('images/whistle-white.png')}}">
                </div>
                <div class="bg-white w-full h-full p-3 flex flex-col justify-center items-center">
                    <p class="">Je souhaite commenter ⏱</p>
                </div>
            </button>
            <button type="button" class="relative commentaires h-24 bg-white commandeMatch items-stretch w-full focus:outline-none" wire:click="matchReporte">
                <div class="minuteCommentaires w-24 commandeMatch flex flex-col justify-center items-center">
                    <img src="{{asset('images/danger.png')}}">
                </div>
                <div class="bg-white w-full h-full p-3 flex flex-col justify-center">
                    <p class="text-center">Le match est reporté ou annulé <i class="fas fa-cloud-showers-heavy"></i></p>
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
                <div class="relative commentaires h-24 bg-white commandeMatch items-stretch w-full focus:outline-none">
                    <div class="minuteCommentaires w-24 commandeMatch flex flex-col justify-center items-center">
                        <img src="{{asset('images/login.png')}}" alt="">
                    </div>
                    <div class="bg-white w-full h-full p-3 flex flex-col justify-center">
                        <p class="font-bold">Je me connecte</p>
                    </div>
                </div>
            </a>
            @endauth
            @endif
            @auth
        </div>
        @if($match->commentateur)
        <div class="my-6 w-11/12 m-auto lg:w-8/12">
            @if($match->commentateur != null && $match->commentateur->user->id == Auth::user()->id)
            @if($match->live == 'attente')
            <button type="button" class="relative commentaires h-24 bg-white commandeMatch items-stretch w-full focus:outline-none" wire:click="timeZero" wire:model="commentator">
                <div class="minuteCommentaires w-24 commandeMatch flex flex-col justify-center items-center">
                    <img src="{{asset('images/whistle-white.png')}}">
                </div>
                <div class="bg-white w-full h-full p-3 flex flex-col justify-center items-center">
                    <p class="font-bold">Démarrer le match</p>
                </div>
            </button>
            @endif
            @if($match->live == 'debut' && now()->diffInMinutes($match->date_match) >= 40)
            <button type="button" class="relative commentaires h-24 bg-white commandeMatch items-stretch w-full focus:outline-none" wire:click="timeMitemps" wire:model="type_comments">
                <div class="minuteCommentaires w-24 commandeMatch flex flex-col justify-center items-center">
                    <img src="{{asset('images/whistle-white.png')}}">
                </div>
                <div class="bg-white w-full h-full p-3 flex flex-col justify-center items-center">
                    <p class="font-bold">Valider la mi-temps</p>
                </div>
            </button>
            @endif
            @if($match->live == 'mitemps')
            <button type="button" class="relative commentaires h-24 bg-white commandeMatch items-stretch w-full focus:outline-none" wire:click="timeReprise" wire:model="type_comments">
                <div class="minuteCommentaires w-24 commandeMatch flex flex-col justify-center items-center">
                    <img src="{{asset('images/whistle-white.png')}}">
                </div>
                <div class="bg-white w-full h-full p-3 flex flex-col justify-center">
                    <p class="font-bold">Valider la reprise</p>
                </div>
            </button>
            @endif
            @if($match->live == 'repriseMT' && now()->diffInMinutes($match->date_match) >= 95)
            <button type="button" class="relative commentaires h-24 bg-white commandeMatch items-stretch w-full focus:outline-none" wire:click="timeFinDuMatch" wire:model="type_comments">
                <div class="minuteCommentaires w-24 commandeMatch flex flex-col justify-center items-center">
                    <img src="{{asset('images/whistle-white.png')}}">
                </div>
                <div class="bg-white w-full h-full p-3 flex flex-col justify-center">
                    <p class="font-bold">Coup de sifflet final ! ⏱</p>
                </div>
            </button>
            @endif
            @endif
            @endauth
        </div>
        @endif
    </form>
    <!-- fin option commentaires "match" -->

    <!-- Affichage des commentaires -->

    @auth
    @if($match->commentateur)
    @if($match->commentateur->user_id == Auth::user()->id)
    <div class="mx-6 my-2 text-right">
        <p class="text-xs cursor-pointer underline" wire:click="needHelp">Besoin d'aide ?</p>
    </div>
    @endif
    @endif
    @endauth
    <div class="my-2 w-11/12 m-auto lg:flex lg:justify-around">
        <div class="m-auto sm:w-10/12 lg:w-8/12">
            @foreach($commentsMatch as $comment)
            <div class="relative commentaires minHeight16 h-auto {{ $comment->team_action }}" x-data="{ open: false }">
                <div class="minuteCommentaires w-24 sm:w-32 {{ $comment->team_action }} p-4 flex flex-col items-center">
                    <div>
                        <p class="text-lg mb-4">{{ $comment->minute}}'</p>
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
                <div class="relative bg-white w-full p-4 flex flex-col">
                    <div class="flex flex-col justify-between">
                        <div class="mb-4">
                            <p class="text-lg font-bold">{{ $comment->type_comments}}</p>
                            <p>{{ $comment->comments }}</p>
                            <div class="flex items-center">
                                @if($comment->team_action == "away" || $comment->team_action == "home")
                                <p class="font-bold mr-4">{{ $comment->statistic->player->first_name}}
                                    {{ $comment->statistic->player->last_name}}
                                </p>
                                @if($comment->statistic->player->id >= 1 && $comment->statistic->player->id <= 16) <button type="button" class="text-xs px-2 bg-primary text-white rounded-md" @click="open = true">
                                    Qui est ce ?
                                    </button>
                                    @endif
                                    @endif
                            </div>
                        </div>
                        <!-- Menu ajout d'un joueur par utilisateur -->
                        <div class="border-t-2 pt-4 flex flex-col justify-center items-center" x-show="open" @click.away="open = false">
                            <h3 class="text-sm">Tu connais ce joueur ?</h3>
                            <div class="flex flex-col">
                                @auth
                                <div class="flex justify-center">
                                    <select class="focus:outline-none focus:shadow-outline my-1 border-2 rounded-md m-1 p-1" name="playerMatch" id="playerMatch" wire:model="playerMatch">
                                        <option value="">Choisis un joueur</option>
                                        @foreach(($comment->team_action == 'home' ? $match->homeClub->players : $match->awayClub->players) as $player)
                                        <option value="{{ $player->id}}">{{$player->first_name}}
                                            {{$player->last_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex flex-col justify-center items-center ">
                                    <p class="text-sm">Ou crée le en mode <span class="font-bold">#rapide</span></p>
                                    <input {{ $playerMatch != "" && $playerMatch != null ? 'disabled' : '' }} wire:model="playerPrenom" name="playerPrenom" class="{{ $playerMatch != "" && $playerMatch == null ? 'cursor-not-allowed' : '' }} text-primary border-b border-primary focus:outline-none w-2/3 sm:m-1 p-1" type="text" placeholder="prénom">
                                    <input {{ $playerMatch != "" && $playerMatch != null ? 'disabled' : '' }} wire:model="playerNom" name="playerNom" class="{{ $playerMatch != "" && $playerMatch != null ? 'cursor-not-allowed' : '' }} text-primary border-b border-primary focus:outline-none w-2/3 m-1 p-1" type="text" placeholder="nom">
                                </div>
                                <button type="button" wire:click="miseAJourJoueur('{{ $comment->team_action }}' ,  {{ $comment->statistic }})">Envoyer</button>
                                @else
                                <div class="my-2 text-center">
                                    <p class="text-xs">pour pouvoir renseigner ce joueur</p>
                                    <a href="/login" class="text-xs px-2 py-1 bg-primary rounded-md text-secondary">
                                        Connecte toi
                                    </a>
                                </div>
                                @endauth
                            </div>
                        </div>
                        <!-- FIN menu ajout d'un joueur par utilisateur -->
                        @if($comment->images != null)
                        <div class="flex justify-center">
                            <a href="{{ asset($comment->images)}}">
                                <img class="max-h-32 rounded-md shadow-xl" src="{{ asset($comment->images)}}" alt="action">
                            </a>
                        </div>
                        @endif
                    </div>
                    <div class="flex justify-end items-end mt-4 mx-1">
                        <p class="text-xs">Commenté par {{ $match->commentateur->user->pseudo }}</p>
                    </div>
                </div>
                @auth
                @if($match->commentateur->user_id == Auth::user()->id && $match->live != "finDeMatch" &&
                ($comment->team_action == "home" || $comment->team_action == "away"))
                <div class="absolute flex justify-center items-center right-1 top-0">
                    <div>
                        <a class="text-lg text-danger" href="{{route('supprimer', ['id' => $comment->id]) }}" onclick="return confirm('Etes vous sûr de vouloir supprimer ce commentaire ?')"><i class="far fa-times-circle"></i></a>
                    </div>
                </div>
                @endif
                @endauth
            </div>
            @endforeach
        </div>
        @if($match->commentateur)
        <div>
            <div class="bg-white rounded-lg border-white w-11/12 m-auto my-8 shadow-2xl lg:my-0 lg:w-auto max-w-sm">
                <div class="bg-primary text-secondary rounded-t-lg">
                    <h3 class="text-center p-2">Le "Thierry Roland" du jour</h3>
                </div>
                <div class="flex justify-evenly items-center p-4">
                    <div>
                        <p class="font-bold">{{$match->commentateur->user->pseudo}}</p>
                    </div>
                    <div class="flex items-center justify-center bg-secondary h-12 w-12 rounded-full m-2">
                        <p>{{$match->commentateur->user->note}}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <!-- Fin affichage des commentaires -->
</div>