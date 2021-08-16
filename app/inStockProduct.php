<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class inStockProduct extends Model
{

    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'material', 'quantity'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function invoices()
    {
        return $this->belongsToMany(invoice::class);
    }
}
