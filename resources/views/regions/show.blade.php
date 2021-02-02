@extends('layout')
@section('content')

<div class="relative w-full py-10 px-4 bg-primary text-white flex justify-center items-center my-6">
    <h2 class="text-4xl lg:text-6xl">{{ $region->name }}</h2>
</div>
@livewire('search-match')

<div class="relative lg:flex lg:justify-center">
    <div class="w-11/12 sm:w-9/12 lg:w-5/12 h-auto mb-2 rounded-md mx-auto p-4">
        @foreach($matchesByRegion->sortByDesc('date_match') as $match)
        <div class="rounded-b-md rounded-tr-md">
            @include('match')
        </div>
        @endforeach
        {{ $matchesByRegion->links() }}
    </div>
</div>


@endsection