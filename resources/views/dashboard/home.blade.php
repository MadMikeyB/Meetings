@extends('layouts.base')

@section('title', 'Dashboard')

@section('headline')
  You are logged in
@endsection

@section('main')
<form class="dashboard container"
      id="mns-form"
      action="/ajax/my_meetings"
      method="GET">
  <input type="hidden" name="q_limit" value="3">
  <div class="meetings-ajax">@include('includes.my_meetings')</div>
  <a href="/meetings" class="button button--light">Show all</a>
  <div class="next-steps-ajax">@include('includes.my_next_steps')</div>
  <a href="next_steps" class="button button--light">Show all</a>
</form>

<div class="ajax">
</div>

@endsection
