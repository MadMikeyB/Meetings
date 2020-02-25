@extends('plan.base')

@section('title', 'Plan new meeting')

@section('plan-nav-buttons')
<a href="/plan/objectives/{{ $meeting->id }}" class="button">Back to objectives</a>
<a href="/plan/summary/{{ $meeting->id }}" class="button">On to summary</a>
@endsection

@section('form')

@php
if(!isset($meeting->agenda_items)) {
  $agenda = [];
  for($i = 0; $i < 5; $i++) {
    $agenda[$i] = new stdClass();
    $agenda[$i]->position = $i;
    $agenda[$i]->name = "Something";
    $agenda[$i]->leader_id = $meeting->user->id;
    $agenda[$i]->addition = "Something additional";
    $agenda[$i]->expected_number_of_minutes = 10;
  }
} else {
  $agenda = $meeting->agenda_items;
}

@endphp

<div class="agenda">
@include('includes.agenda')
</div>

<span id="add-agenda-item" m-id="{{ $meeting->id }}">Add agenda item</span>
@endsection
