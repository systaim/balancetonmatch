@extends('layout')
@section('content')
<section>

    @livewire('create-match', [
    'regions' => $regions,
    'groups' => $groups,
    'departments' => $departments,
    'divisionsDepartments' => $divisionsDepartments,
    'divisionsRegions' => $divisionsRegions,
    'competitions' => $competitions
    ])
</section>
@endsection