<?php

namespace App;

class Meeting extends UuidModel
{
  protected $fillable = [
    'cocreator_id',
    'name',
    'series',
    'location',
    'room',
    'additional',
  ];

  public function objectives() {
    return $this->hasMany(Objective::class);
  }
  public function expectations() {
    return $this->hasMany(Expectation::class);
  }
  public function decisions() {
    return $this->hasMany(Decision::class);
  }
  public function notes() {
    return $this->hasMany(Note::class);
  }
  public function benefits() {
    return $this->hasMany(Benefit::class);
  }
  public function concerns() {
    return $this->hasMany(Concern::class);
  }

  public function nextsteps() {
    return $this->hasMany(NextStep::class);
  }


  public function days() {
    return $this->hasMany(Day::class);
  }
  public function agenda_items() {
    return $this->hasManyThrough(AgendaItem::class, Day::class);
  }
}
