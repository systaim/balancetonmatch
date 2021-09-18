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
    <div class="my-8 m-auto w-11/12 xl:w-8/12">
        <div class="flex justify-center">
            <h3 class="titlePage">Les joueurs</h3>
        </div>
        <div class="flex flex-col justify-center items-center">
            @foreach ($club->players->sortBy('last_name') as $key => $player)
                <a class="relative flex flex-grow w-full m-2 shadow-2xl"
                    href="{{ route('clubs.players.show', ['club' => $club->id, 'player' => $player->id]) }}">
                    <div
                        class="h-full flex items-center border-gray-800 border p-4 rounded-lg bg-primary text-white w-full">
                        <img alt="{{ $player->first_name }} {{ $player->last_name }}"
                            class="w-16 h-16 bg-gray-100 object-cover object-center flex-shrink-0 rounded-full mr-4"
                            src="{{ asset($player->avatar_path) }}">
                        <div class="flex-grow">
                            <h2 class=" title-font font-medium truncate">{{ $player->first_name }}
                                {{ $player->last_name }}</h2>
                            <p class="">{{ $player->position }}</p>
                        </div>
                    </div>
                    <div class="absolute bottom-2 right-2 rounded-lg py-1 px-2 text-xs text-white">
                        voir le joueur →
                    </div>
                </a>
            @endforeach
            @auth
                @if (Auth::user()->club_id == $club->id)
                    <a class="flex flex-grow w-full m-2 shadow-2xl" href="{{ route('clubs.players.create', $club) }}">
                        <div
                            class="h-full flex items-center border-gray-800 border p-4 rounded-lg bg-success text-black w-full">

                            <div class="w-16 h-16 bg-white flex justify-center items-center rounded-full mr-4">
                                <p class="text-6xl text-black">+</p>
                            </div>
                            <div class="flex-grow">
                                <h2 class=" title-font font-medium truncate">Ajouter un joueur</h2>
                            </div>
                        </div>
                    </a>

                    {{-- <div
                        class="relative w-72 m-4 bg-success text-darkGray flex flex-col justify-between rounded-lg overflow-hidden shadow-2xl">
                        <a href="{{ route('clubs.players.create', $club) }}">
                            <div class="flex justify-between">
                                <div class="flex justify-center items-center h-80 w-full bg-gray-400 rounded-br-lg">
                                    <p class="giant-text text-gray-500">+</p>
                                </div>
                                <div class="text-lg flex justify-center items-start p-2">
                                    <p class="vertical mx-2 font-semibold">Ajouter un joueur</p>
                                </div>
                            </div>
                            <div class="relative flex p-2">
                                <p class="font-semibold">Ajouter un joueur</p>
                            </div>
                        </a>
                    </div> --}}
                    @else
                    <p class="my-5 bg-orange-500 py-1 px-2 rounded-lg shadow-2xl border">Il faut faire parti du club pour ajouter un joueur</p>
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
