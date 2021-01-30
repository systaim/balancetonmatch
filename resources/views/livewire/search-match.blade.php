<form wire:submit="searchMatch" class="flex justify-center">
    <div class="inline-block relative">
        <input wire:model="search" class="inputForm" type="text" name="search" placeholder="Nom d'une équipe">
        <i class="absolute text-xl mt-3 mr-3 top-0 right-0 text-primary fas fa-search"></i>
        <div>
            {{ $search }}
            @dump($search)
            @foreach($matches as $match)
            <div>
                <a href="{{ route('matches.show',$match) }}">
                    {{  $match->competition->id }}
                    {{  $match->competition->name }}
                    <p class="text-primary bg-white px-2 py-2 rounded-md my-2">{{ $match->homeClub->name }} <span class="font-bold px-3 py-5 bg-secondary text-primary mx-2 rounded-md"> VS </span> {{ $match->awayClub->name }}</p>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</form>