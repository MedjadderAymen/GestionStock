<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class desktop extends Model
{
    protected $fillable = [
        'in_stock_product_id', 'cpu', 'ram', 'disk', 'vc'
    ];

    public function inStockProduct()
    {
        return $this->belongsTo(inStockProduct::class);
    }
}
