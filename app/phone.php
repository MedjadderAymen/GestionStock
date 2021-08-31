<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class phone extends Model
{
    protected $fillable = [
        'in_stock_product_id','cession'
    ];

    public function inStockProduct()
    {
        return $this->belongsTo(inStockProduct::class);
    }
}
