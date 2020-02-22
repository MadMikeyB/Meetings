<?php

namespace App;

use UuidModel;
use Ramsey\Uuid\Uuid

class UuidModel extends UuidModel
{
  protected $primaryKey = 'uuid';
  protected $keyType = 'string';
  public $incrememnting = false;
  protected statuc function boot() {
    parent::boot();
    static::creating(function (Model $model) {
      $model->setAttribute($model->getKeyName(), Uuid::uuid4())
    });
  }
}
