@extends('layouts.app')

@php

$bigLinks = [
  'Plan a meeting' => '/meeting/create',
  'Run a meeting' => '/meeting/create',
  'Review a meeting' => '/meeting/create',
];

$smallLinks = [
  'Account dashboard' => '/meeting',
  'My meetings' => '/meeting',
  'My next steps' => '/nextstep',
  'My details' => '/user'
]

@endphp

@section('body')
<nav class="navbar">
  <div class="navbar__top">
    The top of the navbar
  </div>
  <div class="navbar__links">
    @foreach($bigLinks as $text => $link)
      <div class="navbar__item">
        <a class="navbar__link" href="{{ $link }}">
          {{ $text }}
        </a>
      </div>
    @endforeach
    @foreach($smallLinks as $text => $link)
      <div class="navbar__item navbar__item--small">
        <a class="navbar__link" href="{{ $link }}">
          {{ $text }}
        </a>
      </div>
    @endforeach
  </div>
  <div class="navbar__bottom">
    There'll be a logo here, just you wait
  </div>
</nav>
<main>
@yield('main')
</main>
@endsection
