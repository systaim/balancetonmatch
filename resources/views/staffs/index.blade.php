@extends('layout')
@section('content')
<section>
    @include('clubs.linkPageClub')
    @include('clubs.logo')
    <div class="my-8">
        <h3 class="text-center mt-4">Le staff</h3>
        @foreach($club->staffs as $staff)
        <div class=" bg-primary text-white rounded-lg relative my-2 p-3">
            <div class="flex flex-col">
                <div>
                    <p class="text-center font-bold mb-2 text-xl">{{ $staff->quality}}</p>
                </div>
                <div>
                    <h4 class="capitalize text-secondary text-center">{{ $staff->first_name}} <span class="uppercase">{{ $staff->last_name}}</span></h4>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div>
        <a href="{{ route('clubs.staffs.create', $club) }}">
            <p class="btn btnPrimary">Ajouter un membre du staff <span>➤</span></p>
        </a>
    </div>
</section>
@endsection