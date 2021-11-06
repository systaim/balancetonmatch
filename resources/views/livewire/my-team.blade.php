
<button type="button" class="px-3 py-2 rounded-md shadow-xl bg-white flex items-center m-" wire:click="itsMyTeam">
    @if ($my_team)
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-3 text-danger" viewBox="0 0 20 20" fill="currentColor">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
          </svg>
    @else
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-3 text-danger" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
          </svg>
    @endif

    @auth
        @if ($user->club_id == $club->id)
            <p class="text-sm">{{ $message }}</p>
        @elseif ($user->club_id == null)
            <p class="text-sm">C'est ta team ? Clique sur l'étoile</p>
        @else
            <p class="text-sm">{{ $message }}</p>
        @endif
    @else
        <a href="/login">
            <div class="text-center flex flex-col justify-center">
                <p class="text-sm">C'est ta team ? </p>
            </div>
        </a>
    @endauth
</button>
