<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class site extends Model
{
    protected $fillable = ['address'];

    public function locations(){
        return $this->hasMany(location::class);
    }
}
