<?php

namespace App\Http\Controllers;

use App\Exports\inStockProductExport;
use App\Exports\PrintersConsumptionReport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function export_mapping() {
        return Excel::download( new inStockProductExport(), 'parcit-'.now()->toDateTimeString().'.xlsx') ;
    }

    public function export_report(){
        return Excel::download( new PrintersConsumptionReport(), 'consommation-'.now()->toDateTimeString().'.xlsx') ;
    }
}
