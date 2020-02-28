@extends('layouts.base')

@section('title', 'My Next Steps')

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
  <div class="next-steps-ajax">@include('includes.my_next_steps')</div>
</form>

@endsection
