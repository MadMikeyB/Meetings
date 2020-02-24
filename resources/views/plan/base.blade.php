@extends('layouts.base')

@section('title', 'Plan new meeting')

@section('headline')
Plan new meeting
<span class="plan-nav-buttons">
@yield('plan-nav-buttons', '')
</span>
@endsection

@section('main')

<div class="container">
<form id="plan-form" action="" method="POST">
@csrf
<input type="hidden" name="id" value="{{ $meeting->id }}">
@yield('form')
</form>
</div>

<span class="plan-nav-buttons">
@yield('plan-nav-buttons')
</span>
@endsection
