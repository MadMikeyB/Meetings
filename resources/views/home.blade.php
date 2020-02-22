@extends('layouts.base')

@section('title', 'Dashboard')

@php
/*
$meetings = [];

for($i = 0; $i < 10; $i++) {
  $meetings[] = [
    "title" => "Meeting ".$i,
    "series" => "Series ".$i,
    "location" => "Location ".$i,
    "organiser" => "Organiser ".$i,
    "time" => "Time ".$i,
  ];
}
*/
@endphp

@section('headline')
  You are logged in
@endsection

@section('main')
<div class="dashboard container">
  @include('includes.my_meetings')
  @include('includes.my_next_steps')
</div>

@endsection
