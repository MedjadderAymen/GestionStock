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
        return inStockProduct::with('location.site')->with('employer.user')->get();
    }

    public function headings () : array
    {
        return [
            '#',
            'Zi',
            'Facture',
            'Constructeur',
            'Modele',
            'Class',
            'Numéro de série',
            "Nom d'employé",
            "Site",
            "Ligne d'adresse 1",
            "Ligne d'adresse 2",
            "Date d'affectation",
            "Caractéristiques",
            "Etat",
            "Cession",
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
