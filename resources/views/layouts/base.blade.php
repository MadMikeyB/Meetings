@extends('layouts.head')

@php

$bigLinks = [
  'Plan a meeting' => [
    'routenameprefix' => 'plan.',
    'url' => '/plan',
    'smalls' => [
      'Details' => '#',
      'Attendees' => '#',
      'Objectives' => '#',
      'Agenda' => '#',
      'Summary' => '#',
    ],
  ],
  'Run a meeting' => [
    'routenameprefix' => 'run.',
    'url' => '/run'
  ],
  'Review a meeting' => [
    'routenameprefix' => 'review.',
    'url' => '/review',
    'smalls' => [
      'Details' => '#',
      'Objectives and expectations' => '#',
      'Benefits and concerns' => '#',
      'Decisions and notes' => '#',
      'Next steps' => '#',
    ],
  ],
];

$smallLinks = [
  'Account dashboard' => '/dashboard',
  'My meetings' => '/meetings',
  'My next steps' => '/next_steps',
  'My contacts' => '/contacts',
  'My details' => '/account'
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
        <a class="navbar__link" href="{{ $link['url'] }}">
          {{ $text }}
        </a>
        @if(isset($link['smalls']) && (strpos(Route::currentRouteName(), $link['routenameprefix']) === 0))
        @foreach($link['smalls'] as $smallText => $smallLink)
          <div class="navbar__item navbar__item--small">
            <a class="navbar__link" href="{{ $smallLink }}">
              {{ $smallText }}
            </a>
          </div>
        @endforeach
        @endif
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
<div class="headline">
@yield('headline')
</div>
@yield('main')
<div class="flex-fill">
</main>
@endsection
