<?php

namespace App;

;

class Attendee extends UuidModel
{
  protected $fillable = [
    'user_id',
    'email'
  ];

  public function meeting() {
    return $this->belongsTo(Meeting::class);
  }

  public function user() {
    return $this->belongsTo(User::class);
  }
}
