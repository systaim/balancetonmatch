@extends('layout')
@section('content')

    @livewire('create-match', [
    'regions' => $regions,
    'groups' => $groups,
    'departments' => $departments,
    'divisionsDepartments' => $divisionsDepartments,
    'divisionsRegions' => $divisionsRegions,
    'competitions' => $competitions
    ])
@endsection