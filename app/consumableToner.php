<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class consumableToner extends Model
{
    protected $fillable = [
        'printer_id', 'reference', 'color', 'quantity', 'help_desk_id'
    ];

    public function Printer()
    {
        $this->belongsTo(printer::class);
    }

    /**
     * @return BelongsTo
     */
    public function helpDesk()
    {
        return $this->belongsTo(helpDesk::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('created_at', 'desc');
        });
    }
}
