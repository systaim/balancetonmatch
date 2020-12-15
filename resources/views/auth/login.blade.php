@extends('layout')
@section('content')
@if (session('status'))
<div class="mb-4 font-medium text-sm text-green-600">
    {{ session('status') }}
</div>
@endif
<div class="bg-login p-4 h-full lg:h-screen">
@include('login')
</div>
@endsection