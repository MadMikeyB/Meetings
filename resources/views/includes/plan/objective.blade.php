@php
if(isset($objective)) {
  $id = $objective->id;
} else {
  $id = $uuid;
}
@endphp

<fieldset class="objectives">
  <input type="hidden" name="objectives[id][]" value="{{ $id }}">
  <input type="text" name="objectives[description][]" value="{{ $objective->description ?? '' }}">
</fieldset>
