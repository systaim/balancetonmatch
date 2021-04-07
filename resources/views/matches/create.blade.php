@extends('layout')
@section('content')

    @livewire('create-match', [
    'regions' => $regions,
    'groups' => $groups,
    'districts' => $districts,
    'divisionsDepartments' => $divisionsDepartments,
    'divisionsRegions' => $divisionsRegions,
    'competitions' => $competitions
    ])
@endsection