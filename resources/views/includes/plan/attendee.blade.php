@php

if(isset($attendee)) {
  $id = $attendee->id;
} else {
  $id = $uuid;
}

@endphp

<fieldset class="attendees">
  <input type="hidden" name="attendees[id][]" value="{{ $id }}">
  <input type="string" name="attendees[user_id][]" value="{{ $attendee->user_id ?? '' }}">
</fieldset>
