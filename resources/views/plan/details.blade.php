@extends('plan.base')

@section('title', 'Plan new meeting')

@section('plan-nav-buttons')
<button class="button">Button</button>
<a href="/plan/attendees/{{ $meeting->id }}" class="button">On to attendees</a>
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

@foreach($vars as $label => $value)
  @php $lower_label = strtolower($label) @endphp
  <label class="label label--large" for="{{ $lower_label}}">{{ $label }}</label>
  <input type="text"
         name="{{ $lower_label}}"
         id="{{ $lower_label}}"
         value="{{ $value }}"
         placeholder="{{ $label }}">
@endforeach

@forelse($meeting->days as $day)
@include('includes.plan.day')
@empty
@include('includes.plan.day')
@endforelse
<span id="add-day">Add another day</span>
@endsection
