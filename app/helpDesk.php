<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class helpDesk extends Model
{
    protected $fillable = [
        'user_id', 'last_logon_time'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'last_logon_time' => 'datetime',
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function invoices()
    {
        return $this->hasMany(invoice::class);
    }

    public function consumableToners()
    {
        return $this->hasMany(consumableToner::class);
    }
}
