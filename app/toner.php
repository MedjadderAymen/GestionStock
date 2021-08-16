<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class toner extends Model
{
    protected $fillable=[
        'reference', 'color', 'quantity'
    ];

    public function invoices()
    {
        return $this->belongsToMany(invoice::class);
    }
}
