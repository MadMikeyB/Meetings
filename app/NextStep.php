<?php

namespace App;

;

class NextStep extends UuidModel
{
  protected $fillable = [
    'user_id',
    'meeting_id',
    'description',
    'completed_by_date',
  ];

  protected $casts = [
    'completed_by_date' => 'datetime',
  ];

  public function meeting() {
    return $this->belongsTo(Meeting::class);
  }
  public function user() {
    return $this->belongsTo(User::class);
  }

  public static function get_for_page($params, $user) {
    $next_steps = array(
      'Incomplete Next Steps' => NextStep::where([
        'is_complete' => false,
      ]),
      'Complete Next Steps' => NextStep::where([
        'is_complete' => true,
      ]),
      'All Next Steps' => NextStep::whereIn(
        'is_complete',
        [true, false]
      ),
    );

    if(isset($params['next_step']['sort'])) {
      $sort_by = explode("_", $params['next_step']['sort']);
    } else {
      $sort_by = ['description', 'asc'];
    }

    foreach($next_steps as $tab => $set) {
      $next_steps[$tab] = $set->orderBy($sort_by[0], $sort_by[1]);
    }

    if(isset($params['next_step']['filter'])) {
      foreach($params['next_step']['filter'] as $key => $value) {
        foreach($next_steps as $tab => $set) {
          $next_steps[$tab] = $set->where($key, 'LIKE', '%'.$value.'%');
        }
      }
    }

    if(isset($params['q_limit'])) {
      foreach($next_steps as $tab => $set) {
        $next_steps[$tab] = $set->take($params['q_limit']);
      }
    }

    foreach($next_steps as $tab => $set) {
      $next_steps[$tab] = $set->where([
        'user_id' => $user->id
      ])->get();

    }

    return $next_steps;
  }
}
