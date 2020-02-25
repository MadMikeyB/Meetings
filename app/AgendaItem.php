<?php

namespace App;

class AgendaItem extends UuidModel
{
//public const TYPE_NORMAL ITEM = 1;
//public const TYPE_BREAK = 2;
//public const TYPE_LUNCH = 3;
//public const TYPE_ICE_BREAKER = 4;
//public const TYPE_OPEN = 5;
//public const TYPE_CLOSE_1 = 6;
//public const TYPE_CLOSE_2 = 7;
//public const TYPE_CLOSE_3 = 8;

  protected $fillable = [
    'position',
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
