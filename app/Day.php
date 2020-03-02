<?php

namespace App;

;

class Day extends UuidModel
{
  protected $fillable = [
    'meeting_id',
    'date',
    'start_at',
    'end_at'
  ];

  protected $casts = [
    'date' => 'date',
    //'start_at' => 'timestamp',
    //'end_at' => 'timestamp'
  ];

  public function meeting() {
    return $this->belongsTo(Meeting::class);
  }

  public function agenda_items() {
    return $this->hasMany(AgendaItem::class)->orderBy("position", "ASC");
  }
  protected static function boot() {
    parent::boot();

    static::deleting(function(Day $day) {
      $day->agenda_items()->delete();
    });
  }
}
