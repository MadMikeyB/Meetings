<?php

namespace App;

;

class Decision extends UuidModel
{
  protected $fillable = [
    'meeting_id',
    'description',
  ];

  public function meeting() {
    return $this->belongsTo(Meeting::class);
  }
}
