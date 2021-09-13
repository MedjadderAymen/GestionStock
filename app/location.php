<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class location extends Model
{
    protected $fillable = [
        'site_id', 'location', 'location_line_one', 'location_line_two'
    ];

    public function site()
    {
        return $this->belongsTo(site::class);
    }

    public function inStockProduct()
    {
        return $this->hasOne(inStockProduct::class);
    }
}
