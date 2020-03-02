@php

if(isset($day)) {
  $id = $day->id;
  $date = $day->date->format('Y-m-d');
  $start_at = $day->start_at;
  $end_at = $day->start_at;
} else {
  $id = $day->id ?? $uuid;
  $date = date("Y-m-d");
  $start_at = date("H:i:s");
  $end_at = date("H:i:s");
}

@endphp

<fieldset class="days">
  <input type="hidden" name="days[id][]" value="{{ $id }}">
  <input type="date" name="days[date][]" value="{{ $date ?? new DateTime('tomorrow') }}">
  <input type="time" name="days[start_at][]" value="{{ $start_at }}">
  <input type="time" name="days[end_at][]" value="{{ $end_at }}">
</fieldset>
