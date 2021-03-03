@extends('layout')
@section('content')
<section class="">
@livewire('create-match', ['clubsHome'=> $clubsHome,'clubsAway'=> $clubsAway, 'regions' => $regions, 'groups' => $groups, 'departments' => $departments,'divisionsDepartments' => $divisionsDepartments, 'divisionsRegions' => $divisionsRegions, 'competitions' => $competitions])
</section>
@endsection