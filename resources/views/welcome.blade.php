@extends('layout')

@section('content')
<section class="">
    <div class="w-full bg-primary h-auto relative py-12">
        <div class="flex justify-center text-secondary">
            <h3 class="mb-4 text-center"></h3>
        </div>
        <div class=" flex flex-row justify-evenly items-center">
            <!-- <div class="h-72 w-96 bg-darkGray text-white">
            </div> -->
            <div class="pl-4 h-72 w-96 bg-darkGray text-white">
                <div class="diagonale pb-4">
                Mes teams <i class="fas fa-heart text-red-700"></i>
                </div>
                @auth
                @foreach($user->favoris as $favori)
                <a href="{{ route('clubs.show', $favori->club->id) }}">
                    <div class="flex items-center my-2">
                        <div class="logo h-10 w-10 cursor-pointer">
                            <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $favori->club->numAffiliation }}.jpg" alt="logo">
                        </div>
                        <div class="diagonale ml-2">
                            {{ $favori->club->name }}
                        </div>
                    </div>
                </a>
                @endforeach
                @endauth
            </div>
        </div>
    </div>
</section>
@endsection