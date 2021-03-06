@php
$meeting_tab = $params['meeting']['tab'] ?? 0;
$sort_type = $params['meeting']['sort'] ?? 'name_asc';
$filter_type = $params['meeting']['filter'] ?? [];
$multi_tabs = count($meetings) > 1;
@endphp

<h2>My Meetings</h2>
<div class="tab-sort-filter">
  @if($multi_tabs)
  <span class="tab-sort-filter__tabs tab-bar" id="meetings-tab">
    @foreach($meetings as $tab_name => $tab)
      <div class="tab {{ $loop->index==$meeting_tab?'active':''}}" tab-index="{{ $loop->index }}">{{ $tab_name }}</div>
    @endforeach
  </span>
  @else
  <span></span>
  @endif



  <!-- Sorting and filtering -->
  <fieldset form="mns-form" name="meetings" class="tab-sort-filter__sorts-filters">
  <input type="hidden" name="meeting[tab]" value="{{ $meeting_tab }}">
  <span>
    <!-- Sorting -->
    <div class="tab-sort-filter__sort-toggle">Sort By</div>
    <div class="tab-sort-filter__sorts">
        @php
        $sorts = [
          "name_asc" => "Name (A-Z)",
          "name_desc" => "Name (Z-A)",
          "location_asc" => "Location (asc)",
          "location_desc" => "Location (desc)",
          "series_asc" => "Series Name (A-Z)",
          "series_desc" => "Series Name (Z-A)",
        ]
        @endphp

      @foreach($sorts as $sort_val => $label)
        <span class="tab-sort-filter__sort-span">
        <input type="radio"
               name="meeting[sort]"
               id="sort-{{$sort_val}}"
               value="{{$sort_val}}"
               {{ $sort_type == $sort_val ? 'checked' : ''}}>
        <label for="sort-{{$sort_val}}">{{$label}}</label>
        </span>
      @endforeach
    </div>

    <!-- Filtering -->
    <div class="tab-sort-filter__filter-toggle">Filter By</div>
    <div class="tab-sort-filter__filters">
        @php
        $filters = [
          "name" => "Name",
          "location" => "Location",
          "series" => "Series",
        ]
        @endphp

      @foreach($filters as $filter_val => $label)
        <label for="sort-{{$filter_val}}">{{$label}}</label>
        <input type="text"
               name="meeting[filter][{{$filter_val}}]"
               id="filter-{{$filter_val}}"
               value="{{ $params['meeting']['filter'][$filter_val] ?? ''}}">
      @endforeach
    </div>
  </span>
  </fieldset>



  <!-- Displaying -->
  <div class="mns-meeting-list card list-group list-group--flush tab-body-bar" controlled-by="meetings-tab">
    @foreach($meetings as $tab_name => $tab)
      <div tab-index="{{ $loop->index }}"
          class="tab-body {{ $loop->index == $meeting_tab?'active':'' }}">
        @forelse($tab as $meeting)
        <div class="meeting list-group__item">
          <div class="meeting__left">
            <span class="{{ !isset($meeting->name) ? 'text-muted' : '' }}">
              {{ $meeting->name ?? 'This meeting has no name' }}
            </span>
            <span>
              <span class="{{ !isset($meeting->series) ? 'text-muted' : '' }}">{{ $meeting->series ?? 'This meeting has no series' }}</span> | {{ $meeting->user->name }}
            </span>
            <span class="{{ !isset($meeting->location) ? 'text-muted' : '' }}">
              {{ $meeting->location ?? 'This meeting has no location' }}
            </span>
            <span class="{{ count($meeting->days) == 0 ? 'text-muted' : '' }}">
              @forelse($meeting->days as $day)
                {{ $day->date->format('d/m/Y') }}
                {{ $day->start_at }}
              @empty
              This meeting has no dates/times set
              @endforelse
            </span>
          </div>
          <div class="meeting__right">
            <div class="meeting__buttons">
          @switch($tab_name)
            @case("Upcoming Meetings")
              @php
              $ucc = [$meeting->user_id, $meeting->cocreator_id]
              @endphp
              @if(in_array(Auth::user()->id, $ucc))
              <a href="/plan/details/{{ $meeting->id }}"class="button button--light">Edit meeting</a>
              <div class="button">Run meeting</div>
              @endif
              @break
            @case("Draft Meetings")
              <a href="/plan/details/{{ $meeting->id }}" class="button">Edit meeting</a>
              @break
            @case("Past Meetings")
              <div class="button button--light">Add a new meeting in this series</div>
              <div class="button">Review meeting</div>
              @break
          @endswitch 
            </div>
          </div>
        </div>
        @empty
        <div class="meeting list-group__item">
        There are no meetings of this type
        </div>
        @endforelse
      </div>
    @endforeach
  </div>
</div>
