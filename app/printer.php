<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class printer extends Model
{
    protected $fillable = [
        'designation', 'ip', 'site', 'affection'
    ];

    public $timestamps = [
        'affectation'
    ];

    public function getAffectationAttribute($value)
    {
        return Carbon::parse($value, 'UTC')->isoFormat('Do MMM YYYY');
    }

    public function Toners()
    {
        return $this->belongsToMany(toner::class)->withPivot('quantity');
    }

    public function PrinterStocks()
    {
        return $this->hasMany(PrinterStock::class);
    }

    public function consumableToners()
    {
        return $this->hasMany(consumableToner::class);
    }
}
