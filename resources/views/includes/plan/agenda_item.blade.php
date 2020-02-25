@php
if(isset($item)) {
  $id = $item->id;
} else {
  $id = $uuid;
}
@endphp


<fieldset class="agenda__items">
  <input type="hidden" name="agenda_items[id][]" value="{{ $id }}">
  <input type="text" name="agenda_items[name][]" value="{{ $item->name ?? ''}}">
  <input type="text"
         name="agenda_items[expected_number_of_minutes][]"
         value="{{ $item->expected_number_of_minutes ?? ''}}">
  <input type="text"
         name="agenda_items[leader_id][]"
         value="{{ $meeting->user_id}}">
</fieldset>
