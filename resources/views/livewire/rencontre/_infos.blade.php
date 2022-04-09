@if ($commentateur)
<div class="flex text-sm">
    <div class="my-3 bg-primary p-2 text-secondary flex-1 m-2 w-1/2">
        <h4 class="mb-2">Commenté en direct par</h4>
        <p>
            {{ $commentateur->user->pseudo }}
            <span
                class=" bg-secondary text-primary px-1 rounded shadow-sm">{{ $commentateur->user->nb_commentaires }}</span>
        </p>
    </div>
    <div class="my-3 bg-primary p-2 text-secondary flex-1 m-2 w-1/2">
        <h4 class="mb-2">Lieu du match</h4>
        <p>
            {{ $match->location?$match->location:'non renseigné' }}
        </p>
    </div>
</div>
    
@endif
