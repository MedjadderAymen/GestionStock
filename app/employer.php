<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class employer extends Model
{
    protected $fillable = [
        'user_id','department','function','company'
    ];

    /**
     * @return BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }


}
