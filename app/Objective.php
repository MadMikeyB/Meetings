<?php

namespace App;

;

class Objective extends UuidModel
{
  protected $fillable = [
    'meeting_id',
    'description',
    'status'
  ];

  public function meeting() {
    return $this->belongsTo(Meeting::class);
  }
}
