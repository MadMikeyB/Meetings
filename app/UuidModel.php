<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class UuidModel extends Model
{
  public $incrementing = false;
  protected static function boot() {
    parent::boot();
    static::creating(function (Model $model) {
      $model->setAttribute($model->getKeyName(), Uuid::uuid4());
    });
  }
}
