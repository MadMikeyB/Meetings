<h2>My Next Steps</h2>
<div class="tab-sort-filter">
  <span class="tab-sort-filter__tabs tab-bar" id="next-steps-tab">
    @for($i = 0; $i < 3; $i++)
      <div class="tab" tab-index="{{$i}}">Tab {{$i}}</div>
    @endfor
  </span>
  <span class="tab-sort-filter__sorts-filters">
    <div>Sort By</div>
    <div>Filter By</div>
  </span>
  <div class="card list-group list-group--flush tab-body-bar" controlled-by="next-steps-tab">
    @for($i = 0; $i < 3; $i++)
    <div tab-index="{{$i}}" class="tab-body {{ $i == 0 ? 'active':''}}">
    @foreach($meetings as $meeting)
      <div class="next-step list-group__item">
        @foreach($meeting as $key => $value)
          <span>{{$i}}'s '{{$key}}:{{$value}}</span>
        @endforeach
      </div>
    @endforeach
    </div>
    @endfor
  </div>
</div>
