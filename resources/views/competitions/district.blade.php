@extends('layout')
@section('content')
    <div class="relative w-full py-10 bg-primary text-white mb-6 flex flex-col items-center -intro-y">
        <h2 class="text-4xl lg:text-6xl text-center">{{ $departement->name }}</h2>
        <h3 class="text-xl lg:text-2xl text-center">{{ $division->name }} {{ $groupe->name }}</h3>
        @can('isSuperAdmin')
            @livewire('recuperation-matchs', [
                'groupe' => $groupe,
                'division' => $division,
                'region' => $region,
                'departement' => $departement,
                'competition_id' => 2,
                'page' => request()->fullUrl(),
            ])
        @endcan
    </div>

    <div class="relative lg:flex lg:justify-center">
        <div class="flex flex-wrap justify-around">
            @foreach ($journees as $journee)
                <div class="mt-4 border rounded-md shadow-lg p-3 lg:w-5/12 intro-y">
                    <h4 class="inline-block px-3 text-center bg-secondary text-primary rounded-sm shadow-lg">
                        Journée {{ $journee->name }}
                    </h4>
                    @foreach ($matchs[$journee->id] as $match)
                        <div>
                            @include('match')
                        </div>
                    @endforeach
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
                <h2 class="text-gray-900 text-lg title-font font-medium mb-2 m-4">Un match est manquant ?</h2>
                <p class="leading-relaxed text-base">Le match que tu recherches n'est pas dans la liste ? N'hésite pas à le
                    créer !</p>
                <a class="flex justify-end" href="{{ route('matches.create') }}">
                    <button class="btn btnSecondary">Je crée un match</button>
                </a>
            </div>
        </div>
    </div>
@endsection
