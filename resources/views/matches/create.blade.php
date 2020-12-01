@extends('layout')
@section('content')
<section class="min-h-screen">
@livewire('create-match', ['clubs'=> $clubs, 'regions' => $regions, 'groups' => $groups, 'divisionsDepartments' => $divisionsDepartments, 'divisionsRegions' => $divisionsRegions])
</section>
@endsection