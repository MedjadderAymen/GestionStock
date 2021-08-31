<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class screen extends Model
{
    protected $fillable = [
        'in_stock_product_id', 'screen'
    ];

    public function inStockProduct()
    {
        return $this->belongsTo(inStockProduct::class);
    }
}
