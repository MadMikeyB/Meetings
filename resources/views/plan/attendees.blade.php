@extends('plan.base')

@section('title', 'Plan new meeting')

@section('plan-nav-buttons')
<a href="/plan/details/{{ $meeting->id }}" class="button">Back to details</a>
<a href="/plan/objectives/{{ $meeting->id }}" class="button">On to objectives</a>
@endsection

@section('form')

<div class="plan__attendees">
    @forelse($meeting->attendees as $attendee)
      @include('includes.plan.attendee')
    @empty
      @include('includes.plan.attendee')
    @endforelse
</div>

<span class="plan__add-something button" id="add-attendee">Add attendee</span>

<div class="plan__guests">
    @forelse($meeting->guests as $guest)
      @include('includes.plan.guest')
    @empty
      @include('includes.plan.guest')
    @endforelse
</div>

<span class="plan__add-something button" id="add-guest">Add guest</span>

<script type="text/template" id="new-attendee">
@include('includes.plan.attendee')
</script>

<script type="text/template" id="new-guest">
@include('includes.plan.guest')
</script>
@endsection
