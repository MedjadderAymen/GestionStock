<?php

namespace App\Exports;

use App\printer;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PrintersTonersAllocationReport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return Collection
     */
    public function collection()
    {
        return printer::with("Toners")->get();
    }

    public function headings () : array
    {
        return [
            '#',
            'Imp',
            'Emplacement',
            'Toner',
            'Couleur',
            'Affecté par',
        ] ;
    }

    public function map($row): array
    {

        switch ($row->class){
            case 'laptop':{
                $characteristics= 'CPU: '.$row->laptop->cpu.'/ RAM: '.$row->laptop->ram.' /Disque: '.$row->laptop->disk.'/ Ecran: '.$row->laptop->screen;
                $cession="Non";
            } break;
            case 'desktop': {
                $characteristics= 'CPU: '.$row->desktop->cpu.'/ RAM: '.$row->desktop->ram.' /Disque: '.$row->desktop->disk;
                $cession="Non";
            }break;
            case 'phone':{
                $characteristics= "";
                $cession=$row->phone->cession ? "Oui" : "Non";
            } break;
            case 'ipad':{
                $characteristics= 'Ecran: '.$row->ipad->dimension;
                $cession="Non";
            } break;
            case 'screen':{
                $characteristics= 'Ecran: '.$row->screen->screen;
                $cession="Non";
            } break;
        }

        return [
            $row->id,
            $row->zi,
            $row->invoice,
            $row->constructor,
            $row->model,
            $row->class,
            $row->serial_number,
            $row->employer->user->name ?? 'non affecté',
            $row->location->site->address ?? 'non affecté',
            $row->location->location_line_one ?? 'non affecté',
            $row->location->location_line_two ?? 'non affecté',
            $row->date_affectation ?? 'non affecté',
            $characteristics,
            $row->status,
            $cession,
        ] ;
    }

}
