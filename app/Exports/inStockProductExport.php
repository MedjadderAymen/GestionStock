<?php

namespace App\Exports;

use App\inStockProduct;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class inStockProductExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return inStockProduct::whereIn('class',['laptop','desktop'])->with('location.site')->with('employer.user')->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'Class',
            'VC',
            'Constructeur',
            'Modele',
            'Numéro de série',
            "nom d'employé",
            "site",
            "ligne d'adresse 1",
            "ligne d'adresse 2"
        ] ;
    }

    public function map($row): array
    {

        if ($row->class == "laptop"){
            $vc="VC".$row->laptop->vc."L";
        }else{
            $vc="VC".$row->desktop->vc."D";
        }

        return [
            $row->id,
            $row->class,
            $vc,
            $row->constructor,
            $row->model,
            $row->serial_number,
            $row->employer->user->name ?? 'non affecté',
            $row->location->site->address ?? 'non affecté',
            $row->location->location_line_one ?? 'non affecté',
            $row->location->location_line_two ?? 'non affecté',
        ] ;
    }
}
