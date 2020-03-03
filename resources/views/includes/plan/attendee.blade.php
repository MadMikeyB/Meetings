@php

$person = $attendee ?? $meeting->user->id;

@endphp


<select name="attendees[]">
  @foreach(Auth::user()->company->users as $u)
    @if($u != $meeting->user)
      <option value="{{ $u->id }}" {{ $person == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
    @endif
  @endforeach
</select>
