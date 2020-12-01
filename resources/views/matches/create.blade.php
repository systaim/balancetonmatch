@extends('layout')
@section('content')
<section class="">
@livewire('create-match', ['clubs'=> $clubs, 'regions' => $regions, 'groups' => $groups, 'divisionsDepartments' => $divisionsDepartments, 'divisionsRegions' => $divisionsRegions])
</section>
@endsection