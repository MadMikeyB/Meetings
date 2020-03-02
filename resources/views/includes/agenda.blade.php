@csrf
@foreach($meeting->days as $day)
<div class="agenda__day">
  {{ $day->id }}<br>
  {{ date('Y-m-d', strtotime($day->date)) }}, {{ $day->start_at }} - {{ $day->end_at }}
  @foreach($day->agenda_items as $item)
    @php
      if(isset($item->leader)) {
        $leader = $item->leader;
      } else {
        $leader = $meeting->user->name;
      }
    @endphp
    <fieldset class="agenda__items">
      <input type="hidden" name="agenda_items[id][]" value="{{ $item->id }}">
      <input type="text" name="agenda_items[name][]" value="{{ $item->name ?? ''}}">
      <input type="text"
            name="agenda_items[expected_number_of_minutes][]"
            value="{{ $item->expected_number_of_minutes ?? ''}}">
      <select name="agenda_items[leader][]">
        @foreach($meeting->item_leaders() as $l)
          <option {{ $l == $leader ? 'selected' : '' }}>{{ $l }}</option>
        @endforeach
      </select>
      {{ $item->type }}
      {{ $item->position }}
      <div id="delete-agenda-item" ai_id="{{ $item->id }}">Delete</div>
    </fieldset>
  @endforeach
  <span class="plan__add-something button" id="add-agenda-item" d_id="{{ $day->id }}" i_type="1">Add agenda item</span>
</div>
@endforeach
