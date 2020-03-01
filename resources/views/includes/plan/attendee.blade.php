@php

$person = $attendee ?? $meeting->user->id;

@endphp


<select name="attendees[]">
  @foreach(Auth::user()->company->users as $u)
    <option value="{{ $u->id }}" {{ $person == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
  @endforeach
</select>
