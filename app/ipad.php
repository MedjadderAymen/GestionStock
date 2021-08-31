<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ipad extends Model
{
    protected $fillable = [
        'in_stock_product_id','dimension'
    ];

    public function inStockProduct()
    {
        return $this->belongsTo(inStockProduct::class);
    }
}
