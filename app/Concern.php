<?php

namespace App;

;

class Concern extends UuidModel
{
  protected $fillable = [
    'meeting_id',
    'description',
  ];

  public function meeting() {
    return $this->belongsTo(Meeting::class);
  }
}
