@extends('layout')
@section('content')

<div class="relative w-full py-10 bg-primary text-white flex justify-center items-center">
    <h2 class="text-4xl">{{ $region->name }}</h2>
</div>

<div class="relative lg:flex lg:justify-center">
    <div class="w-11/12 m-auto lg:w-9/12">
        @foreach($matchesByRegion->sortByDesc('date_match') as $match)
        <div class="rounded-b-md rounded-tr-md">
            @include('match')
        </div>
        @endforeach
        {{ $matchesByRegion->links() }}
    </div>
</div>


@endsection