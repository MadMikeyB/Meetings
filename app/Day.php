<?php

namespace App;

;

class Day extends UuidModel
{
  protected $fillable = [
    'meeting_id',
    'start_at',
    'end_at'
  ]

  public function meeting() {
    return $this->belongsTo(Meeting::class);
  }

  public function agenda_items() {
    return $this->hasMany(AgendaItem::class);
  }
}
