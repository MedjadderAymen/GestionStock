<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrinterStock extends Model
{
    protected $fillable = [
        'printer_id', 'reference', 'color', 'quantity'
    ];

    public function Printer()
    {
        $this->belongsTo(printer::class);
    }

}
