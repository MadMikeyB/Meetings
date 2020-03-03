<?php

namespace App;

class Meeting extends UuidModel
{

  protected $attributes = [
    'attendees' => "[]",
    'guests' => "[]",
  ];

  protected $fillable = [
    'cocreator_id',
    'name',
    'series',
    'location',
    'room',
    'additional',
    'attendees',
    'guests',
  ];

  protected $casts = [
    'attendees' => 'array',
    'guests' => 'array',
  ];

  public function user() {
    return $this->belongsTo(User::class);
  }
  public function objectives() {
    return $this->hasMany(Objective::class);
  }
  public function expectations() {
    return $this->hasMany(Expectation::class);
  }
  public function decisions() {
    return $this->hasMany(Decision::class);
  }
  public function notes() {
    return $this->hasMany(Note::class);
  }
  public function benefits() {
    return $this->hasMany(Benefit::class);
  }
  public function concerns() {
    return $this->hasMany(Concern::class);
  }
  public function nextsteps() {
    return $this->hasMany(NextStep::class);
  }
  public function days() {
    return $this->hasMany(Day::class)->orderBy('date', 'asc');
  }
  public function agenda_items() {
    return $this->hasManyThrough(AgendaItem::class, Day::class);
  }

  public static function get_for_page($params, $user) {
    $meetings = array(
      'Upcoming Meetings' => Meeting::where([
        'is_complete' => false,
        'is_draft' => false,
      ]),
      'Draft Meetings' => Meeting::where([
        'is_draft' => true,
      ]),
      'Past Meetings' => Meeting::where([
        'is_complete' => true,
        'is_draft' => false,
      ]),
    );

    if(isset($params['meeting']['sort'])) {
      $sort_by = explode("_", $params['meeting']['sort']);
    } else {
      $sort_by = ['name', 'asc'];
    }

    foreach($meetings as $tab => $set) {
      $meetings[$tab] = $set->orderBy($sort_by[0], $sort_by[1]);
    }

    if(isset($params['meeting']['filter'])) {
      foreach($params['meeting']['filter'] as $key => $value) {
        foreach($meetings as $tab => $set) {
          $meetings[$tab] = $set->where($key, 'LIKE', '%'.$value.'%');
        }
      }
    }

    if(isset($params['q_limit'])) {
      foreach($meetings as $tab => $set) {
        $meetings[$tab] = $set->take($params['q_limit']);
      }
    }

    foreach($meetings as $tab => $set) {
      $meetings[$tab] = $set->where([
        'user_id' => $user->id
      ])->orWhere([
        'cocreator_id' => $user->id
      ])->get();
    }

    return $meetings;
  }

  public function all_attendees() {
    $attendees['creator'][] = $this->user->name;
    if($this->co_creator) {
      $attendees['co-creator'][] = $this->co_creator->name;
    }
    foreach(User::whereIn('id', $this->attendees)->get() as $u) {
      $attendees['user'][] = $u->name;
    };
    $attendees['guest'] = $this->guests;


    return $attendees;
  }

  public function item_leaders() {
    $item_leaders = [];
    foreach($this->all_attendees() as $a) {
      foreach($a as $l) {
        $item_leaders[] = $l;
      }
    }
    return $item_leaders;
  }

  protected static function boot() {
    parent::boot();

    static::deleting(function(Meeting $meeting) {
      $meeting->objectives()->delete();
      $meeting->expectations()->delete();
      $meeting->decisions()->delete();
      $meeting->notes()->delete();
      $meeting->benefits()->delete();
      $meeting->concerns()->delete();
      $meeting->nextsteps()->delete();
      $meeting->days()->delete();
    });
  }
}
