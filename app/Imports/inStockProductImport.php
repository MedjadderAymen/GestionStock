<?php

namespace App\Imports;

use App\inStockProduct;
use Maatwebsite\Excel\Concerns\ToModel;

class inStockProductImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new inStockProduct([
            //
        ]);
    }
}
