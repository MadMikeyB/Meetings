<?php

namespace App;

class Company extends UuidModel
{
  protected $fillable = [
    'name',
    'logo_path'
  ];

  public function users() {
    return $this->hasMany(User::class);
  }
}
