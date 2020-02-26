@php
$meeting_tab = $params['meeting']['tab'] ?? 0;
$sort_type = $params['meeting']['sort'] ?? 'name_asc';
$filter_type = $params['meeting']['filter'] ?? [];
@endphp

<h2>My Meetings</h2>
<div class="tab-sort-filter">
  @if(count($meetings) > 1)
  <span class="tab-sort-filter__tabs tab-bar" id="meetings-tab">
    @foreach($meetings as $tab_name => $tab)
      <div class="tab {{ $loop->index==$meeting_tab?'active':''}}" tab-index="{{ $loop->index }}">{{ $tab_name }}</div>
    @endforeach
  </span>
  @else
  <span></span>
  @endif



  <!-- Sorting and filtering -->
  <fieldset form="mns-form" name="meetings">
  <input type="hidden" name="meeting[tab]" value="{{ $meeting_tab }}">
  <span class="tab-sort-filter__sorts-filters">
    <!-- Sorting -->
    <div class="tab-sort-filter__sort-toggle">Sort By</div>
    <div class="tab-sort-filter__sorts">
        @php
        $sorts = [
          "name_asc" => "Name (asc)",
          "name_desc" => "Name (desc)",
          "location_asc" => "Location (asc)",
          "location_desc" => "Location (desc)",
          "series_asc" => "Series (asc)",
          "series_desc" => "Series (desc)",
        ]
        @endphp

      @foreach($sorts as $sort_val => $label)
        <label for="sort-{{$sort_val}}">{{$label}}</label>
        <input type="radio"
               name="meeting[sort]"
               id="sort-{{$sort_val}}"
               value="{{$sort_val}}"
               {{ $sort_type == $sort_val ? 'checked' : ''}}>
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
            <span>{{ $meeting->name }}</span>
            <span>{{ $meeting->series }} | {{ $meeting->user->name }}</span>
            <span>{{ $meeting->location }}</span>
            <span>
              @foreach($meeting->days as $day)
                {{ $day->date->format('d/m/Y') }}
                {{ $day->start_at }}
              @endforeach
            </span>
          </div>
          <div class="meeting__right">
          @switch($tab_name)
            @case("Upcoming Meetings")
              <div class="button">Run meeting</div>
              @break
            @case("Draft Meetings")
              <div class="button">Edit meeting</div>
              @break
            @case("Past Meetings")
              <div class="button">Review meeting</div>
              @break
          @endswitch 
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
