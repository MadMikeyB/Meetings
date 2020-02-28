<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Ramsey\Uuid\Uuid;

class User extends Authenticatable
{
    use Notifiable;

    const ROLE_GUEST = 0;
    const ROLE_USER = 1;
    const ROLE_COMPANY_ADMIN = 10;
    const ROLE_SITE_ADMIN = 100;

    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function (User $model) {
            $model->setAttribute($model->getKeyName(), Uuid::uuid4());
        });
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
