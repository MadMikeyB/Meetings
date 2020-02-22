<?php

namespace App;

;

class NextStep extends UuidModel
{
  protected $fillable = [
    'user_id',
    'meeting_id',
    'description',
    'completed_by_date',
  ];

  protected $casts = [
    'completed_by_date' => 'datetime',
  ];

  public function meeting() {
    return $this->belongsTo(Meeting::class);
  }
  public function user() {
    return $this->belongsTo(User::class);
  }
}
