<?php

namespace App;

;

class Expectation extends UuidModel
{
  protected $fillable = [
    'meeting_id',
    'description',
  ];

  public function meeting() {
    return $this->belongsTo(Meeting::class);
  }
}
