<h2>My Meetings</h2>
<div class="tab-sort-filter">
  <span class="tab-sort-filter__tabs tab-bar" id="meetings-tab">
    @for($i = 0; $i < 3; $i++)
      <div class="tab {{ $i==0?'active':''}}" tab-index="{{$i}}">Tab {{$i}}</div>
    @endfor
  </span>
  <span class="tab-sort-filter__sorts-filters">
    <div>Sort By</div>
    <div>Filter By</div>
  </span>
  <div class="card list-group list-group--flush tab-body-bar" controlled-by="meetings-tab">
    @for($i = 0; $i < 3; $i++)
    <div tab-index="{{$i}}" class="tab-body {{ $i == 0 ? 'active':''}}">
    @foreach($meetings as $meeting)
      <div class="meeting list-group__item">
        {{ $meeting->name }}
        {{ $meeting->location }}
      </div>
    @endforeach
    </div>
    @endfor
  </div>
</div>
