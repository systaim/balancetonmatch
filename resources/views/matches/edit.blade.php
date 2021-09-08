@extends('layout')
@section('content')

    <div class="relative w-full py-10 px-4 bg-primary text-white flex flex-col justify-center items-center mb-6">
        <h2 class="text-4xl lg:text-6xl">Modifier le match</h2>
        <div class="flex flex-col md:flex-row justify-evenly items-center w-11/12 md:w-2/3">
            <h3 class="text-xl flex-1 text-right truncate">{{ $match->homeClub->name }}</h3>
            <div class="text-4xl mx-4 font-bold flex-1 text-center">VS</div>
            <h3 class="text-xl flex-1 ext-left truncate">{{ $match->awayClub->name }}</h3>
        </div>
    </div>

    <form action="{{ route('matches.update', ['match' => $match]) }}" method="post">
        @method('PUT')
        @csrf
        <div class="flex flex-col justify-evenly mb-4 w-11/12 md:w8/12 lg:w-6/12 mx-auto">
            <div class="flex justify-evenly">
                <div class="flex flex-col w-2/5">
                    <label for="dateMatch">Date</label>
                    <input autofocus class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="date"
                        name="dateMatch" id="dateMatch" :value="old('dateMatch')" value="{{ $dateDuMatch }}"
                        autocomplete="dateMatch" required>
                    @error('dateMatch')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex flex-col w-2/5">
                    <label for="time">Heure</label>
                    <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="time" name="time"
                        id="time" :value="old('time')" autocomplete="time" value="{{ $heureDuMatch }}" required>
                    @error('time')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="flex justify-evenly">
                <div class="flex flex-col w-2/5">
                    <label for="location">Lieu du match</label>
                    <input value="{{ $match->location }}" class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="text" name="location"
                        id="location">
                </div>
            </div>
        </div>
        <div class="flex justify-end mb-4 w-11/12 md:w8/12 lg:w-6/12 mx-auto">
            <input class="btn btnSuccess" type="submit" value="Modifier">
        </div>
    </form>


@endsection
