@extends('layout')
@section('content')
@livewire('create-match', ['clubs'=> $clubs, 'regions' => $regions, 'groups' => $groups, 'divisionsDepartments' => $divisionsDepartments, 'divisionsRegions' => $divisionsRegions])
@endsection