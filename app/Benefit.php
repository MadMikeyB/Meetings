<?php

namespace App;

;

class Benefit extends UuidModel
{
  protected $fillable = [
    'meeting_id',
    'description',
  ];

  public function meeting() {
    return $this->belongsTo(Meeting::class);
  }
}
