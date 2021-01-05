<div>
    <div class="inline-block relative">
        <input wire:model="search" class="inputForm" type="text" name="search">
        <i class="absolute text-xl mt-3 mr-3 top-0 right-0 text-primary fas fa-search"></i>
        <div>
            @dump($matchs)

            {{-- @foreach($matchs as $match)
            <p>{{ $match->date_match }}</p>
            <p>{{ $match->homeClub->name }} VS {{ $match->awayClub->name }}</p>
            @endforeach --}}


        </div>
    </div>
</div>