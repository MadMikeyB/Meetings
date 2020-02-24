@extends('layouts.base')

@section('title', 'Choose a meeting')

@section('headline')
  You are logged in
@endsection

@section('main')

<form class="dashboard container"
      id="run-form"
      action=""
      method="GET">
  <div class="meetings-ajax">@include('includes.my_meetings')</div>
</form>

@endsection
