@extends('layout')
@section('content')
<div class="relative w-full py-10 px-4 bg-primary text-white flex flex-col lg:flex-col-reverse justify-center items-center mb-6">
    <h2 class="text-4xl lg:text-6xl">Notifications</h2>
</div>
<section>
    <div class="w-11/12 md:w-8/12 mx-auto lg:ml-auto">
        @if (Auth::user()->notifications->count() != 0)
            @foreach (Auth::user()->notifications as $notification)
                @if ($notification->read_at < now() && $notification->read_at > now()->subWeek(1))
                    <div class="p-3 border-b bg-cool-gray-200 m-1 rounded-xl shadow-xl overflow-hidden text-cool-gray-400">
                @else
                    <div class="p-3 border-b bg-white m-1 rounded-xl shadow-xl overflow-hidden">
                @endif
                    @if ($notification->type == "App\Notifications\matchBegin")
                        <a href="{{ route('matches.show', $notification->data["match_id"]) }}">
                            <div>
                                <p class="uppercase text-gray-400 font-semibold text-xs">{{ $notification->created_at->diffForHumans()}}</p>
                            </div>
                            <div class="flex justify-start items-center">
                                <div class="{{ $notification->read_at < now()?"bg-gray-600":"bg-red-600"}} inline-block px-2 py-1 rounded-md text-white mr-6 font-bold">LIVE</div>
                                <div class="">
                                    <p class="text-sm truncate">{{ $notification->data["homeClub"] }}</p>
                                    <img src="{{ asset('images/vs-primary.png') }}" alt="versus" class="h-6 ml-3">
                                    <p class="text-sm truncate">{{ $notification->data["awayClub"] }}</p>
                                    <p class="{{ $notification->read_at < now()?"bg-gray-600":"bg-primary"}} inline-block text-white rounded-lg font-bold p-2 mt-2 flex-none">Le match a démarré</p>
                                </div>
                            </div>
                        </a>
                    @endif
                    @if ($notification->type == "App\Notifications\but")
                        <a href="{{ route('matches.show', $notification->data["match_id"]) }}">
                            <div>
                                <p class="uppercase text-gray-400 font-semibold text-xs">{{ $notification->created_at->diffForHumans()}}</p>
                            </div>
                            <div class="flex justify-start items-center">
                                <div class="{{ $notification->read_at < now()?"bg-gray-600":"bg-red-600"}} inline-block px-2 py-1 rounded-md text-white mr-6 font-bold">LIVE</div>
                                <div>
                                    <p class="text-sm truncate">{{ $notification->data["homeClub"] }}</p>
                                    <img src="{{ asset('images/vs-primary.png') }}" alt="versus" class="h-6 ml-6">
                                    <p class="text-sm truncate">{{ $notification->data["awayClub"] }}</p>
                                    <p class="{{ $notification->read_at < now()?"bg-gray-600":"bg-success"}} inline-block p-2 rounded-lg font-bold mt-2">{{ $notification->data['text'] }}</p>
                                </div>
                            </div>
                        </a>
                    @endif
                    @if ($notification->type == "App\Notifications\matchEnd")
                        <a href="{{ route('matches.show', $notification->data["match_id"]) }}">
                            <div>
                                <p class="uppercase text-gray-400 font-semibold text-xs">{{ $notification->created_at->diffForHumans()}}</p>
                            </div>
                            <div class="flex justify-start items-center">
                                <div class="{{ $notification->read_at < now() && $notification->read_at > now()->subWeek(1)?"bg-gray-600":"bg-red-600"}} inline-block px-2 py-1 rounded-md text-white mr-6 font-bold">LIVE</div>
                                <div class="">
                                    <p class="text-sm truncate">{{ $notification->data["homeClub"] }}</p>
                                    <img src="{{ asset('images/vs-primary.png') }}" alt="versus" class="h-6 ml-3">
                                    <p class="text-sm truncate">{{ $notification->data["awayClub"] }}</p>
                                    <p class="{{ $notification->read_at < now() && $notification->read_at > now()->subWeek(1)?"bg-gray-600":"bg-primary"}} inline-block text-white rounded-lg font-bold p-2 mt-2 flex-none">Le match est terminé</p>
                                </div>
                            </div>
                        </a>
                    @endif
                </div>
                {{ $notification->markAsRead() }}
            @endforeach
        @else
            <p class="text-2xl  text-center mt-10 mb-32 bg-orange-500 text-gray-900 p-4 rounded-lg">Pas de nouvelles notifications pour le moment <i class="far fa-bell-slash text-3xl"></i></p>
        @endif
    </div>
</section>
@endsection