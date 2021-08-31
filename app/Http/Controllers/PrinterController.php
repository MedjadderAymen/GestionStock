<?php

namespace App\Http\Controllers;

use App\printer;
use App\toner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PrinterController extends Controller
{

    public function index()
    {
        return view('printer.printers')->with('printers', printer::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {

        $data = Validator::make($request->only('designation', 'site', 'ip', 'affectation'), [
            'designation' => ['string', 'required', 'max:255'],
            'site' => ['required', 'string', 'max:255'],
            'ip' => ['required', 'ipv4', 'max:255'],
            'affectation' => ['required', 'date'],
        ]);

        if ($data->fails()) {
            $error['message'] = "validation error";
            return response()->json($data->errors(), 404);
        }

        printer::create([
            "designation" => $request['designation'],
            "site" => $request['site'],
            "ip" => $request['ip'],
            "affectation" => $request['affectation'],
        ]);

        return redirect()->back();
    }

    public function showRedirect(printer $printer)
    {
        return ['redirect' => route('printer.show', ['printer' => $printer])];

    }

    public function show(printer $printer)
    {
        $magentas = toner::all()->where("color", "=", "Magenta");
        $cyans = toner::all()->where("color", "=", "Cyan");
        $yellows = toner::all()->where("color", "=", "Jaune");
        $blacks = toner::all()->where("color", "=", "Noir");

        $toners = $printer->PrinterStocks->groupBy('color');

        $consumableTonersChart = $printer->consumableToners->whereBetween('created_at', [Carbon::now()->subMonths(7), Carbon::now()])->groupBy(function ($îtem) {
            return Carbon::parse($îtem->created_at)->format('Y-m');
        });


        $consumableToners = $printer->consumableToners()->paginate(6);

        $printerColors = [];

        foreach ($toners as $key => $value) {

            $total = 0;

            foreach ($value as $item) {

                $total += $item->quantity;

            }

            $printerColors[$key] = $total;
        }

        $consumableTonersColors = $printer->consumableToners->groupBy('color');

        $consumableColors = [];

        foreach ($consumableTonersColors as $key => $value) {

            $total = 0;

            foreach ($value as $item) {

                $total += $item->quantity;

            }

            $consumableColors[$key] = $total;
        }

        return view('printer.show')
            ->with('printer', $printer)
            ->with('magentas', $magentas)
            ->with('cyans', $cyans)
            ->with('yellows', $yellows)
            ->with('blacks', $blacks)
            ->with('printerColors', $printerColors)
            ->with('consumableTonersChart', $consumableTonersChart->reverse())
            ->with('consumableTonersColors', $consumableColors)
            ->with('consumableToners', $consumableToners);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\printer $printer
     * @return \Illuminate\Http\Response
     */
    public function edit(printer $printer)
    {
        //
    }


    public function update(Request $request, printer $printer)
    {

        $toner = toner::find($request['reference']);

        if ($toner->quantity < $request['quantity']) {

            Session::flash("error", "Quantité non disponble");
            return redirect()->back();

        }

        if ($toner->quantity == $request['quantity']) {
            Session::flash("success", "Toners ajoutés, quantité du toner " . $toner->reference . " couleur: " . $toner->color . " dans le stock est terminée");
        } else {
            Session::flash("success", "Toners ajoutés");
        }

        $printer->toners()->attach($request['reference'], ['quantity' => $request['quantity']]);

        //-----add to printer stock

        $printerStock = $printer->PrinterStocks()->firstOrCreate(
            ['reference' => $toner->reference, 'color' => $toner->color],
            ['reference' => $toner->reference, 'quantity' => 0, 'color' => $toner->color]
        );

        $printerStock->quantity += $request['quantity'];
        $printerStock->save();

        //-------------------------

        $toner->quantity -= $request['quantity'];
        $toner->save();


        return redirect()->back();

    }

    public function destroy(printer $printer)
    {
        $printer->delete();

        return redirect()->back();
    }
}