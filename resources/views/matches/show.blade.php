@extends('layout')
@section('content')

<section>
    @livewire('form-commentaires', [
    'commentator'=> $commentator,
    'nbrFavoris'=> $nbrFavoris,
    'match' =>$match,
    'clubHome' => $clubHome,
    'clubAway' => $clubAway,
    'commentsMatch' => $commentsMatch,
    'competitions' => $competitions,
    'stats' => $stats,
    'pages' => $pages,
    ])
</section>

@endsection