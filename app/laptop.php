<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class laptop extends Model
{
    protected $fillable = [
        'in_stock_product_id', 'cpu', 'ram', 'disk', 'screen','vc','bag'
    ];

    public function inStockProduct()
    {
        return $this->belongsTo(inStockProduct::class);
    }
}
