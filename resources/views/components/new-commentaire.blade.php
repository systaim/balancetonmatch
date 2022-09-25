@if ($comment->team_action == 'match')
    <div class="text-xs px-3 bg-primary text-secondary py-2 mb-5">
        <p>{!! $comment->comments !!} </p>
        @if ($comment->type_comments == 3 && !$match->validate_score)
            @auth
                <div class="flex my-3 items-center">
                    <p>Le score est correct ?</p>
                    <button class="border rounded-sm px-1 border-secondary ml-10"
                        wire:click="validateScoreMatch">Oui</button>
                </div>
                <p>Sinon tu peux renseigner les infos supplémentaires</p>
            @else
                <a href="/login">Connecte toi pour renseigner les infos supplémentaires</a>
            @endauth
        @elseif($comment->type_comments == 3)
            <p>{{ $match->validate_by ? 'Score validé par ' . $match->validate_by_user->pseudo : '' }}</p>
        @endif
    </div>
@endif
<div class="flex items-center w-11/12 mx-auto my-1 {{ $comment->team_action == 'away' ? 'flex-row-reverse' : '' }}">
    <div class="flex {{ $comment->team_action == 'away' ? 'flex-row-reverse' : '' }} items-center {{ $comment->team_action != 'match' ? 'border rounded-md shadow-lg px-2 py-1 my-1' : '' }}">
        @if ($comment->type_action != 'substitute' && $comment->team_action != 'match')
            <p class="text-sm font-bold {{ $comment->team_action == 'away' ? 'ml-2 text-right' : 'text-left mr-2' }}">
                {{ $comment->minute }}'</p>
            <img class="w-4 h-4 mx-1 text-center" src="{{ asset($comment->icon) }}" alt="">
            <p class="text-sm {{ $comment->team_action == 'away' ? 'mr-2' : 'ml-2' }}">
                {{ $comment->{$comment->type_action}->player->full_name }}</p>
            @if ($comment->type_action == 'goal' && $comment->passeur_id)
                <div class="flex items-center">
                    {{-- <img class="w-4 h-4 mx-1 text-center" src="{{ asset('images/passeD.png') }}" alt=""> --}}
                    <p class="flex items-center text-xs {{ $comment->team_action == 'away' ? 'flex-row-reverse' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-3 w-3 {{ $comment->team_action == 'home' ? 'transform rotate-180 ml-2' : '' }}"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ $comment->passeur->player->full_name }}
                    </p>
                </div>
            @endif
            @if (isset($comment->comments))
                <p class="text-xs {{ $comment->team_action == 'away' ? 'mr-2' : 'ml-2' }}">
                    {{ '(' . $comment->comments . ')' }}
                </p>
            @endif
        @endif
    </div>
    <div
        class="flex {{ $comment->team_action == 'away' ? 'flex-row-reverse' : '' }} items-center">

        @if ($comment->type_action == 'substitute')
            <p class="text-sm font-bold {{ $comment->team_action == 'away' ? 'ml-2 text-right' : 'text-left mr-2' }}">
                {{ $comment->minute }}'
            </p>
            <img class="w-4 h-4 text-center" src="{{ asset($comment->icon) }}" alt="">
            <div>
                <div class="text-sm flex items-center {{ $comment->team_action == 'away' ? 'flex-row-reverse mr-2' : 'ml-2' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ $comment->in_substitute->player->full_name }}
                </div>
                <div class="text-sm flex items-center {{ $comment->team_action == 'away' ? 'flex-row-reverse mr-2' : 'ml-2' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-600" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ $comment->out_substitute->player->full_name }}
                </div>
            </div>
        @endif
        @if ($comment->commentator->user_id == Auth::id() && $comment->team_action != 'match')
        <div class="{{ $comment->team_action == 'away' ? 'mr-4' : 'ml-4' }}">
            <button type="button" wire:click="openDeleteComment({{ $comment->id }})">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 border border-primary rounded-full"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </div>
            
        @endif
    </div>
</div>

@if ($commentIdToDelete == $comment->id)
    <div class="flex flex-col items-center">
        <p class="text-sm">Es-tu sûr de vouloir supprimer ce commentaire ?</p>
        <p class="text-sm">Le score se mettra à jour automatiquement</p>
        <div>
            <button type="button"
                class="text-sm px-2 py-1 border border-secondary bg-primary rounded-md m-2 text-secondary shadow-lg"
                wire:click="supprimerCommentaire({{ $comment->id }}, '{{ $comment->team_action }}')">
                Ouaip !
            </button>
            <button type="button"
                class="text-sm px-2 py-1 border border-secondary bg-primary rounded-md m-2 text-secondary shadow-lg"
                wire:click="setCommentIdToDeleteToNull">
                Non
            </button>
        </div>
    </div>
@endif
