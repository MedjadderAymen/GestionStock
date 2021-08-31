<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class employer extends Model
{
    protected $fillable = [
        'user_id','department','function','company','vc'
    ];

    /**
     * @return BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function inStockProducts()
    {
        return $this->hasMany(inStockProduct::class);
    }

    public function inStockProductHistory()
    {
        return $this->belongsToMany(inStockProduct::class)->withPivot('created_at')->orderBy('pivot_created_at', 'desc');
    }


}
