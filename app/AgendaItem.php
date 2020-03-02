<?php

namespace App;

class AgendaItem extends UuidModel
{
   const TYPE_NORMAL_ITEM = 1;
   const TYPE_BREAK = 2;
   const TYPE_LUNCH = 3;
   const TYPE_ICE_BREAKER = 4;
   const TYPE_OPEN = 5;
   const TYPE_CLOSE_1 = 6;
   const TYPE_CLOSE_2 = 7;
   const TYPE_CLOSE_3 = 8;

  protected $fillable = [
    'day_id',
    'name',
    'type',
    'leader',
    'position',
    'additional',
    'expected_number_of_minutes',
    'actual_number_of_minutes',
  ];

  public function day() {
    return $this->belongsTo(Day::class);
  }

}
