<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class inStockProduct extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'constructor', 'model', 'serial_number', 'zi', 'affected', 'status', 'employer_id', 'class', 'invoice','date_affectation'
    ];

    /**
     * @return BelongsTo
     */
    public function employer()
    {
        return $this->belongsTo(employer::class);
    }


    public function invoices()
    {
        return $this->belongsToMany(invoice::class);
    }

    public function laptop()
    {
        return $this->hasOne(laptop::class);
    }

    public function desktop()
    {
        return $this->hasOne(desktop::class);
    }

    public function screen()
    {
        return $this->hasOne(screen::class);
    }

    public function phone()
    {
        return $this->hasOne(phone::class);
    }

    public function ipad()
    {
        return $this->hasOne(ipad::class);
    }

    public function employersHistory()
    {
        return $this->belongsToMany(employer::class)->withPivot('date_affectation')->orderBy('pivot_date_affectation', 'desc');
    }

    public function location(){
        return $this->belongsTo(location::class);
    }

}
