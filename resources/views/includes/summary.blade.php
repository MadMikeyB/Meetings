@php
$vars = [
  "Name" => $meeting->name ?? "No name set",
  "Series" => $meeting->series ?? "No series set",
  "Location" => $meeting->location ?? "No location set",
  "Room" => $meeting->room ?? "No room set",
  "Additional" => $meeting->additional ?? "No additional information",
]
@endphp

<h3>Details</h3>
<div class="card">
  <ul>
    @foreach($vars as $k => $v)
    <li><strong>{{ $k }}:</strong> {{ $v }}</li>
    @endforeach
  </ul>
</div>

<h3>Attendees</h3>
<div class="card">
  <ul>
    @foreach($meeting->all_attendees() as $type => $people)
      @foreach($people as $person)
      <li>{{ $person }} <small>{{ $type }}</small></li>
      @endforeach
    @endforeach
  </ul>
</div>

<h3>Objectives</h3>
<div class="card">
  <ul>
    @foreach($meeting->objectives as $objective)
      <li>{{ $objective->description }}</li>
    @endforeach
  </ul>
</div>

<h3>Agenda</h3>
@foreach($meeting->days as $day_no => $day)
<div class="card">
  <h5>Day {{ $day_no + 1 }}</h5>
  <ul>
    @foreach($day->agenda_items as $ai)
      <li>{{ $ai->name }}</li>
    @endforeach
  </ul>
</div>
@endforeach

