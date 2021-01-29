@extends('layout')
@section('content')

@livewire('search-teams', [
'clubs' => $clubs,
'regions' => $regions,
'departements' => $departements,
])

@endsection