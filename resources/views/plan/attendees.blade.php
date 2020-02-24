@extends('plan.base')

@section('title', 'Plan new meeting')

@section('plan-nav-buttons')
<a href="/plan/details/{{ $meeting->id }}" class="button">Back to details</a>
<a href="/plan/objectives/{{ $meeting->id }}" class="button">On to objectives</a>
@endsection


@php
$vars = [
  "Name" => $meeting->name,
  "Series" => $meeting->series,
  "Location" => $meeting->location,
  "Room" => $meeting->room,
  "Additional" => $meeting->additional,
]


@endphp

@section('form')

@forelse($meeting->attendees as $attendee)
@include('includes.plan.attendee')
@empty
@include('includes.plan.attendee')
@endforelse

<span id="add-attendee">Add attendee</span>
@endsection
