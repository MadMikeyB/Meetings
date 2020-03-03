@csrf
@foreach($meeting->days as $day_no => $day)
<div class="agenda__day">
  {{ $day->id }}<br>
  {{ date('Y-m-d', strtotime($day->date)) }}, {{ $day->start_at }} - {{ $day->end_at }}




  @foreach($day->agenda_items as $day_item_no => $item)
    @php
      if(isset($item->leader)) {
        $leader = $item->leader;
      } else {
        $leader = $meeting->user->name;
      }

      $normal_item = $item->type < 5;
    @endphp
    <div
      id="{{ $item->id }}"
      class="agenda__item"
      data-position="{{ $item->position }}"
      @if($normal_item)
      draggable="true"
      ondragstart="dragTest(event)"
      ondragenter="event.preventDefault()"
      ondragover="dragOverTest(event)"
      ondragleave="dragLeaveTest(event)"
      ondrop="dropTest(event)"
      @endif
      >

      @if($normal_item)
      <div class="agenda__sort-handle" ai_id="{{ $item->id }}">MOVE</div>
      @endif
      <input type="hidden" name="agenda_items[id][]" value="{{ $item->id }}">
      <input type="text" name="agenda_items[name][]" value="{{ $item->name ?? ''}}">
      <input type="text"
            name="agenda_items[expected_number_of_minutes][]"
            value="{{ $item->expected_number_of_minutes ?? ''}}">
      <select name="agenda_items[leader][]">
        @foreach($meeting->item_leaders() as $l)
          <option @if($l === $leader) selected @endif>{{ $l }}</option>
        @endforeach
      </select>
      @if($normal_item)
      <div id="delete-agenda-item" ai_id="{{ $item->id }}">Delete</div>
      @endif
    </div>
  @endforeach



  <div class="agenda__day__footer">
    @foreach(["Add agenda item", "Add break", "Add lunch", "Add ice-breaker"] as $i => $b)
      <span class="plan__add-something button agenda__add-item" id="add-agenda-item" d_id="{{ $day->id }}" i_type="{{ $i + 1}}">{{ $b }}</span>
    @endforeach
  </span>
</div>
@endforeach
