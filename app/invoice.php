<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use NumberFormatter;

class invoice extends Model
{

    protected $fillable = [
        "help_desk_id", "provider", "serial_number", "total_price",
    ];

    /**
     * @return BelongsTo
     */
    public function helpDesk()
    {
        return $this->belongsTo(helpDesk::class);
    }

    public function getTotalPriceAttribute($value)
    {

        $formatter = new NumberFormatter("en_USA", NumberFormatter::CURRENCY);


        return $formatter->formatCurrency($value, 'DZD');
    }

    public function inStockProducts()
    {
        return $this->belongsToMany(inStockProduct::class)->withPivot('quantity','product_price');
    }

    public function Toners()
    {
        return $this->belongsToMany(toner::class)->withPivot('quantity','toner_price');
    }
}
