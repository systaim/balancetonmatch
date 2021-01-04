<div>
    <div class="inline-block relative">
        <input wire:model="search" class="inputForm" type="text" name="search">
        <i class="absolute text-xl mt-3 mr-3 top-0 right-0 text-primary fas fa-search"></i>
        <div>
            @foreach($clubs as $club)
            <p>{{ $club->name }}</p>
            @if(is_array($matchs) || is_object($matchs))
            @foreach($matchs as $match)
            @include('match')
            @dump($match)
            @endforeach
            @endif
            @endforeach
        </div>
    </div>

</div>