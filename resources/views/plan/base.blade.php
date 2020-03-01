@extends('layouts.base')

@section('title', 'Plan new meeting')

@section('headline')
Plan new meeting
<span class="plan-nav-buttons">
@yield('plan-nav-buttons', '')
</span>
@endsection

@section('main')

<div class="plan container">
<div class="plan__errors"></div>
<form id="plan-form" action="" method="POST">
@csrf
<input type="hidden" name="id" value="{{ $meeting->id }}">
@yield('form')
</form>
<div class="plan__success"></div>
</div>

<span class="plan-nav-buttons">
@yield('plan-nav-buttons')
</span>
@endsection
