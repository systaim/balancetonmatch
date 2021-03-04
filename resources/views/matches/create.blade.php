@extends('layout')
@section('content')
<section>

    @livewire('create-match', [
    'regions' => $regions->filter(),
    'groups' => $groups->filter(),
    'departments' => $departments->filter(),
    'divisionsDepartments' => $divisionsDepartments->filter(),
    'divisionsRegions' => $divisionsRegions->filter(),
    'competitions' => $competitions->filter()
    ])
</section>
@endsection