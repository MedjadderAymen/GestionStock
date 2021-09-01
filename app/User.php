<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use LdapRecord\Laravel\Auth\AuthenticatesWithLdap;
use LdapRecord\Models\Relations\HasMany;

class User extends Authenticatable
{
    use Notifiable, AuthenticatesWithLdap;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'email', 'password', 'phone_number', 'role', 'username', 'name', 'windows_username', 'sap', 'active'
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

    /**
     * Always capitalize the first name when we retrieve it
     */
    public function getNameAttribute($value)
    {
        return ucwords($value);
    }



    /**
     * Always capitalize the first name when we save it to the database
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
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
    public function supervisor()
    {
        return $this->hasOne(supervisor::class);
    }

    /**
     * @return HasOne
     */
    public function employer()
    {
        return $this->hasOne(employer::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('name', 'asc');
        });
    }
}
