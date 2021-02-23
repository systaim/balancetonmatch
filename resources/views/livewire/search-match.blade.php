<div class="flex flex-col w-6/12 m-auto">
    <div class="relative">
        <input wire:model="search" class="inputForm w-full" type="text" name="search" placeholder="Nom d'une équipe">
        <i class="absolute text-xl mt-3 mr-3 top-0 right-0 text-primary fas fa-search"></i>
    </div>
    <div>
        @foreach($matches as $match)
        <div>
            <a href="{{ route('matches.show',$match) }}">
            <div class="text-primary bg-white px-2 py-2 hover:bg-blue-200">
                <p>{{ $match->date_match->formatLocalized('%d/%m/%y') }} {{ $match->date_match->formatLocalized('%H:%M')}}</p>
                <p class="truncate">{{ $match->homeClub->name }} <span class=""> VS </span> {{ $match->awayClub->name }}</p>
            </div>
            </a>
        </div>
        @endforeach
    </div>
</div>