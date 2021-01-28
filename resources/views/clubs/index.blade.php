@extends('layout')
@section('content')

@livewire('search-teams', [
'clubs' => $clubs,
])

@endsection