@extends('layout')
@section('content')

    <section class="body-font">
        <div class="container px-2 lg:py-36 py-4 mx-auto text-white">
            <div class="flex flex-wrap justify-center">
                <div class="p-4 w-11/12 md:w-1/3 h-48 my-2">
                    <a href="matches/coupe-de-france-2021-2022">
                        <div class="relative h-48 border-2 rounded-lg overflow-hidden shadow-2xl">
                            <img class="w-full object-cover object-center h-full" src="{{ asset('images/Coupe-de-france.jpg') }}"
                                alt="Coupe de France">
                            <h3 class="absolute bottom-1 left-1 title-font text-lg bg-primary text-white p-1 rounded-lg">COUPE DE FRANCE</h3>
                        </div>
                    </a>
                </div>
                <div class="p-4 w-11/12 md:w-1/3 h-48 my-2">
                    <a href="matches/coupe-de-bretagne-2021-2022">
                        <div class="relative h-48 border-2 rounded-lg overflow-hidden shadow-2xl">
                            <img class="w-full object-cover object-center h-full" src="{{ asset('images/bzh.png') }}" alt="coupe de Bretagne">
                            <h3 class="absolute bottom-1 left-1 title-font text-lg bg-primary text-white p-1 rounded-lg">COUPE DE BRETAGNE</h3>
                        </div>
                    </a>
                </div>
                <div class="p-4 w-11/12 md:w-1/3 h-48 my-2">
                    <a href="matches/amicaux-2021-2022">
                        <div class="relative h-48 border-2 rounded-lg overflow-hidden shadow-2xl">
                            <img class="w-full object-cover object-center h-full" src="{{ asset('images/amicaux.jpg') }}"
                                alt="Coupe de France">
                            <h3 class="absolute bottom-1 left-1 title-font text-lg bg-primary text-white p-1 rounded-lg">Matchs amicaux</h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>





@endsection
