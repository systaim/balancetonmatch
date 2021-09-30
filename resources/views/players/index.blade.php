@extends('layout')
@section('content')
    @include('clubs.linkPageClub')
    @include('clubs.logo')
    <div class="flex justify-center">
        @error('last_name')
            <span class="error">{{ $message }}</span>
        @enderror
        @error('first_name')
            <span class="error">{{ $message }}</span>
        @enderror
    </div>
    <div class="my-8 m-auto w-11/12 xl:w-8/12 min-h-screen">
        <div class="flex justify-center">
            <h3 class="titlePage">Les joueurs</h3>
        </div>
        <div class="flex flex-col justify-center items-center">
            @foreach ($club->players->sortBy('last_name') as $key => $player)
                <a class="relative flex flex-grow w-full m-2 shadow-2xl"
                    href="{{ route('clubs.players.show', ['club' => $club->id, 'player' => $player->id]) }}">
                    <div class="h-full flex items-center border-gray-800 border p-4 rounded-lg bg-primary text-white w-full">
                        <img alt="{{ $player->first_name }} {{ $player->last_name }}"
                            class="w-16 h-16 bg-gray-100 object-cover object-center flex-shrink-0 rounded-full mr-4"
                            src="{{ asset($player->avatar_path) }}">
                        <div class="flex-grow">
                            <h2 class=" title-font font-medium truncate">{{ $player->first_name }}
                                {{ $player->last_name }}</h2>
                            <p class="">{{ $player->position }}</p>
                        </div>
                    </div>
                    <div class="
                                absolute bottom-2 right-2 rounded-lg py-1 px-2 text-xs text-white">
                                voir le joueur →
                        </div>
                </a>
            @endforeach
            @auth
                @if (Auth::user()->club_id == $club->id)
                    <a href="{{ route('clubs.players.create', $club) }}">
                        <div
                            class="fixed z-50 bottom-20 lg:bottom-10 right-4 lg:right-10 h-16 w-16 bg-secondary border shadow-xl rounded-full flex items-center justify-center">
                            <p class="text-6xl text-primary">+</p>
                        </div>
                    </a>
                @endif
            @endauth
        </div>
    </div>
@endsection

{{-- <script>
    function openMenu(id) {
        let players = <?php echo json_encode($club->players); ?>;
        players.forEach(player => {
            if (player.id == id) {
                let form = document.getElementById(id)
                form.style.display = "flex"
            }
        });
    }
</script> --}}
