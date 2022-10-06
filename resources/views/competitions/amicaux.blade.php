@extends('layout')
@section('content')
    <div
        class="relative w-full py-10 px-4 bg-primary text-white flex flex-col lg:flex-col-reverse justify-center items-center mb-6">
        <h2 class="text-4xl lg:text-6xl">Matchs amicaux</h2>
    </div>

    <div class="relative lg:flex lg:justify-center">
        <div class="lg:w-9/12">

            @livewire('search-match-amicaux')

            @foreach ($matchs as $match)
                <div class="rounded-b-md rounded-tr-md">
                    @include('match')
                </div>
            @endforeach
        </div>
    </div>
    <div class="container px-5 mx-auto my-4">
        <div
            class="flex items-center lg:w-3/5 mx-auto border p-10 border-primary sm:flex-row flex-col rounded-lg shadow-2xl">
            <div
                class="sm:w-32 sm:h-32 h-20 w-20 sm:mr-10 inline-flex items-center justify-center rounded-full bg-secondary text-primary flex-shrink-0">
                <i class="fas fa-plus text-4xl"></i>
            </div>
            <div class="flex-grow sm:text-left text-center mt-6 sm:mt-0">
                <h2 class="text-gray-900 text-lg title-font font-medium mb-2 m-4">Créer un match</h2>
                <p class="leading-relaxed text-base">Le match que tu recherches n'est pas dans la liste ? N'hésite pas à le
                    créer !</p>
                <a class="flex justify-end" href="{{ route('matches.create') }}">
                    <button class="btn btnSecondary">Je crée un match</button>
                </a>
            </div>
        </div>
    </div>


@endsection
