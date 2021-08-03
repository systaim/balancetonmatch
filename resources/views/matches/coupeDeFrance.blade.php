@extends('layout')
@section('content')

<div class="relative w-full py-10 px-4 bg-primary text-white flex flex-col lg:flex-col-reverse justify-center items-center mb-6">
    <h2 class="text-4xl lg:text-6xl">COUPE DE FRANCE</h2>
</div>

    <div class="relative lg:flex lg:justify-center">
        <div class="lg:w-9/12">

            @livewire('search-match-coupe-de-france')
            <h2 class="text-2xl pl-4 font-normal">1er tour</h2>
            @foreach ($matchs as $match)
                <div class="rounded-b-md rounded-tr-md">
                    @include('match')
                </div>
            @endforeach
        </div>
    </div>


@endsection
