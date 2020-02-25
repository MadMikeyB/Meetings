@foreach($meeting->days as $day)
<div class="agenda__day">
  {{ $day->id }}<br>
  {{ $day->date }}<br>
  {{ $day->start_at }}<br>
  {{ $day->end_at }}<br>
  @foreach($day->agenda_items as $item)
    @include('includes.plan.agenda_item')
    <div class="agenda__day__items">
      {{ $item->name }}
      {{ $item->expected_number_of_minutes }}
    </div>
  @endforeach
@endforeach
