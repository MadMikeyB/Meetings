@extends('plan.base')

@section('title', 'Plan new meeting')

@section('plan-nav-buttons')
<a href="/plan/attendees/{{ $meeting->id }}" class="button">Back to attendees</a>
<a href="/plan/agenda/{{ $meeting->id }}" class="button">On to agenda</a>
@endsection

@section('form')

@forelse($meeting->objectives as $objective)
@include('includes.plan.objective')
@empty
@include('includes.plan.objective')
@endforelse

<span id="add-objective">Add objective</span>
@endsection
