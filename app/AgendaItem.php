<?php

namespace App;

class AgendaItem extends UuidModel
{
  /*      - 1: Normal item
   *      - 2: Break
   *      - 3: Lunch
   *      - 4: Ice-breaker
   *      - 5: Open
   *      - 6: Close 1
   *      - 7: Close 2
   *      - 8: Close 3
   */

    //
  protected $fillable = [
    'leader_id',
    'type',
    'name',
    'additional',
    'expected_number_of_minutes',
    'actual_number_of_minutes',
  ];

  public function meeting() {
    return $this->belongsTo(Meeting::class);
  }

  public function leader() {
    return $this->belongsTo(User::class, 'leader_id');
  }

}
