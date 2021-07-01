<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'phone_number', 'role'
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

    protected $dates = [
        'deleted_at'
    ];

    /**
     * Always capitalize the first name when we retrieve it
     */
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Always capitalize the first name when we save it to the database
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
    }

    /**
     * @return HasOne
     */
    public function admin()
    {
        return $this->hasOne(admin::class);
    }

    /**
     * @return HasOne
     */
    public function helpDesk()
    {
        return $this->hasOne(helpDesk::class);
    }

    /**
     * @return HasOne
     */
    public function employer()
    {
        return $this->hasOne(employer::class);
    }
}
