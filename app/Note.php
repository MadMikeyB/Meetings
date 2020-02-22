<?php

namespace App;

;

class Note extends UuidModel
{
  protected $fillable = [
    'meeting_id',
    'description',
  ];

  public function meeting() {
    return $this->belongsTo(Meeting::class);
  }
}
