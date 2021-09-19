<?php

namespace App\Http\Controllers;

use App\consumableToner;
use App\printer;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ConsumableTonerController extends Controller
{


    public function __construct()
    {

        $this->middleware(['helpDesk'])->except(['index','show']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        // dd($request->all());

        DB::beginTransaction();

        try {
            $printer = printer::find($request['printer']);

            $printerStocks = $printer->PrinterStocks->where('color', $request['color'])->where('quantity', '>', 0)->first();

            if (empty($printerStocks) || $printerStocks->quantity <= 0) {
                Session::flash("error", "Quantité non disponble");
                return redirect()->back();
            } else {

                $printer->consumableToners()->create([
                    "help_desk_id" => Auth::user()->helpDesk->id,
                    'reference' => $printerStocks->reference,
                    'color' => $printerStocks->color,
                    'quantity' => 1,
                ]);

                $printerStocks->quantity--;
                $printerStocks->save();

            }

        }catch (ValidationException $e){

            DB::rollBack();

            Session::flash("error", $e->getMessage());
            return redirect()->back();
        }

        DB::commit();

        return redirect()->back();


    }

    /**
     * Display the specified resource.
     *
     * @param \App\consumableToner $consumableToner
     * @return \Illuminate\Http\Response
     */
    public function show(consumableToner $consumableToner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\consumableToner $consumableToner
     * @return \Illuminate\Http\Response
     */
    public function edit(consumableToner $consumableToner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\consumableToner $consumableToner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, consumableToner $consumableToner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\consumableToner $consumableToner
     * @return \Illuminate\Http\Response
     */
    public function destroy(consumableToner $consumableToner)
    {
        //
    }
}
