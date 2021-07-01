<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Money\Currency;
use Money\Money;
use NumberFormatter;

class invoice extends Model
{

    protected $fillable = [
        "help_desk_id", "provider", "serial_number", "total_price"
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

        $formatter= new NumberFormatter("en_USA", NumberFormatter::CURRENCY);


        return $formatter->formatCurrency($value, 'DZD');
    }
}
