<?php

namespace App\Exports;

use App\consumableToner;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PrintersConsumptionReport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return Collection
     */
    public function collection()
    {
        return consumableToner::all();
    }

    public function headings(): array
    {
        return [
            'Imp',
            'Emplacement',
            'IP',
            'Toner',
            'Couleur',
            'Affecté par',
        ];
    }

    public function map($row): array
    {

        return [
            $row->printer->designation,
            $row->printer->site,
            $row->printer->ip,
            $row->reference,
            $row->color,
            $row->helpDesk->user->name
        ];

    }
}
