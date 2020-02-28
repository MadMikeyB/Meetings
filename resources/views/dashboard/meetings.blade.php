@extends('layouts.base')

@section('title', 'My Meetings')

@section('headline')
  You are logged in
@endsection

@section('main')

<!--
  {{ print_r($params, true) }}
-->

<form class="dashboard container"
      id="mns-form"
      action=""
      method="GET">
  <div class="meetings-ajax">@include('includes.my_meetings')</div>
</form>

@endsection
