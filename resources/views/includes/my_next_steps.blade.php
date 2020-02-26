@php
$next_step_tab = $params['next_step']['tab'] ?? 0;
$sort_type = $params['next_step']['sort'] ?? 'description_asc';
$filter_type = $params['next_step']['filter'] ?? [];
@endphp


<h2>My Next Steps</h2>
<div class="tab-sort-filter">
  @if(count($next_steps) > 1)
  <span class="tab-sort-filter__tabs tab-bar" id="next_steps-tab">
    @foreach($next_steps as $tab_name => $tab)
      <div class="tab {{ $loop->index==$next_step_tab?'active':''}}" tab-index="{{ $loop->index }}">{{ $tab_name }}</div>
    @endforeach
  </span>
  @else
  <span></span>
  @endif



  <!-- Sorting and filtering -->
  <fieldset form="mns-form" name="next_steps">
  <input type="hidden" name="next_step[tab]" value="{{ $next_step_tab }}">
  <span class="tab-sort-filter__sorts-filters">
    <!-- Sorting -->
    <div class="tab-sort-filter__sort-toggle">Sort By</div>
    <div class="tab-sort-filter__sorts">
        @php
        $sorts = [
          "description_asc" => "Description (asc)",
          "description_desc" => "Description (desc)",
        ]
        @endphp

      @foreach($sorts as $sort_val => $label)
        <label for="sort-{{$sort_val}}">{{$label}}</label>
        <input type="radio"
               name="next_step[sort]"
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
          "description" => "Description",
        ]
        @endphp

      @foreach($filters as $filter_val => $label)
        <label for="sort-{{$filter_val}}">{{$label}}</label>
        <input type="text"
               name="next_step[filter][{{$filter_val}}]"
               id="filter-{{$filter_val}}"
               value="{{ $params['next_step']['filter'][$filter_val] ?? ''}}">
      @endforeach
    </div>
  </span>
  </fieldset>



  <!-- Displaying -->
  <div class="mns-next-step-list card list-group list-group--flush tab-body-bar" controlled-by="next_steps-tab">
    @foreach($next_steps as $tab_name => $tab)
      <div tab-index="{{ $loop->index }}"
          class="tab-body {{ $loop->index == $next_step_tab?'active':'' }}">
        @forelse($tab as $next_step)
        <div class="next_step list-group__item">
          {{ $next_step->description }}
          {{ $next_step->is_complete }}
        </div>
        @empty
        <div class="next-step list-group__item">
        There are no next steps of this type
        </div>
        @endforelse
      </div>
    @endforeach
  </div>
</div>
