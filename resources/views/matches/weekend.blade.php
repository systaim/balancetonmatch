@extends('layout')
@section('content')

<div class="relative w-full py-10 px-4 bg-primary text-white flex justify-center items-center mb-6">
    <h2 class="text-4xl lg:text-6xl">Les matchs du week-end</h2>
</div>
<div class="w-11/12 sm:w-9/12 lg:w-5/12 h-auto mb-2 rounded-md mx-auto p-4">
    @if(empty($matches))

    <div class="flex flex-col items-center text-center">
        <p class="text-xl my-4">OUPS... Pas de match prévu encore ce week-end</p>
    </div>
    @else

    @foreach($competitions as $competition)
    

    @foreach($matches[$competition->id]->sortBy('date_match') as $match)
    @if($match->date_match->formatLocalized('%V') == now()->week() && $match->date_match->formatLocalized('%Y') == '2021')
    @if($match->date_match->formatLocalized('%A') == "vendredi" || $match->date_match->formatLocalized('%A') == "samedi" || $match->date_match->formatLocalized('%A') == "dimanche" ||
    $match->date_match->formatLocalized('%A') == "Friday" || $match->date_match->formatLocalized('%A') == "Saturday" || $match->date_match->formatLocalized('%A') == "Sunday")
    @include('match')
    @endif
    @endif
    @endforeach

    @endforeach

    @endif
</div>


@endsection