@extends('layouts.base')

@section('title', 'Plan new meeting')

@section('headline', 'Plan new meeting')

@section('main')

<div class="container">
<form id="plan-form" action="" method="POST">
@csrf
@yield('form')
<button class="button" id="submit-button" m_id="{{ $meeting->id }}">Save</button>
</form>
</div>

<pre id="ajax">
</pre>
@endsection
