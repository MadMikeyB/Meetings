@extends('layouts.base')

@section('title', 'Account details')

@section('headline', 'Edit your account details')

@php
$vars = [
  "Name" => $user->name,
  "Email" => $user->email,
  "ID" => $user->id,
  "Role" => $user->role,
]
@endphp

@section('main')
<form class="account container" method="POST">
@csrf
@method('put')
@foreach($vars as $label => $value)
  @php $lower_label = strtolower($label) @endphp
  <label class="label label--large" for="{{ $lower_label}}">{{ $label }}</label>
  <input type="text"
         name="{{ $lower_label}}"
         id="{{ $lower_label}}"
         value="{{ $value }}"
         placeholder="{{ $label }}">
  <span class="plan__errors"></span>
@endforeach
</form>
@endsection

