@extends('layouts.head')

@section('title', 'Run Meeting')

@php

$item = $meeting->agenda_items[$item_index];

@endphp

@section('body')

<nav class="navbar">
@foreach($meeting->agenda_items as $ai)
<a href="/run/{{ $meeting->id }}/{{ $loop->index }}"
   class="navbar__item {{ $loop->index == $item_index ? 'active' : '' }}">
  {{ $ai->name }}
</a>

@endforeach
</nav>
<main class="run">
<div class="headline">
  {{ $item->name }}
  @if($item_index > 0)
  <a class="button" href="/run/{{$meeting->id}}/{{ $item_index - 1}}">
    Previous item
  </a>
  @endif
  @if($item_index < count($meeting->agenda_items) - 1)
  <a class="button" href="/run/{{$meeting->id}}/{{ $item_index + 1}}">
    Next item
  </a>
  @endif
  

  
</div>

@switch($item->type)

@case(5)
The opener
@break
@case(6)
Close part 1
@break
@case(7)
Close part 2 - closing boogaloo
@break
@case(8)
Close parth 3 - revenge of the sith
@break
@default
Anyfuckingthing else
@break






@endswitch
</main>

@endsection
