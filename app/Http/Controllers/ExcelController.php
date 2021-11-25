<?php

namespace App\Http\Controllers;

use App\Exports\inStockProductExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function export_mapping() {
        return Excel::download( new inStockProductExport(), 'parcit-'.now()->toDateTimeString().'.xlsx') ;
    }
}
