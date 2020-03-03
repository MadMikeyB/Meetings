@extends('plan.base')

@section('plan-nav-buttons')
<a href="/plan/agenda/{{ $meeting->id }}" class="button">Back to agenda</a>
@endsection

@section('form')

@include('includes.summary')

@endsection
