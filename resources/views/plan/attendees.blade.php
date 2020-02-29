@extends('plan.base')

@section('title', 'Plan new meeting')

@section('plan-nav-buttons')
<a href="/plan/details/{{ $meeting->id }}" class="button">Back to details</a>
<a href="/plan/objectives/{{ $meeting->id }}" class="button">On to objectives</a>
@endsection

@section('form')

<fieldset class="attendees">
  <span class="attendees__col">
    @forelse($meeting->attendees as $attendee)
      @include('includes.plan.attendee')
    @empty
      @include('includes.plan.attendee')
    @endforelse
  </span>
</fieldset>

<span id="add-attendee">Add attendee</span>

<fieldset class="guests">
  <span class="guests__col">
    @forelse($meeting->guests as $guest)
      @include('includes.plan.guest')
    @empty
      @include('includes.plan.guest')
    @endforelse
  </span>
</fieldset>

<span id="add-guest">Add guest</span>

<script type="text/template" id="new-attendee">
@include('includes.plan.attendee')
</script>

<script type="text/template" id="new-guest">
@include('includes.plan.guest')
</script>
@endsection
