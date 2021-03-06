<?php

namespace App\Http\Controllers;

use App\inStockProduct;
use App\invoice;
use App\toner;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class InvoiceController extends Controller
{

    public function __construct()
    {

        $this->middleware(['helpDesk'])->except(['index','show']);

    }

    public function index()
    {
        return view("invoice.invoices")->with("invoices", invoice::all());
    }

    public function create()
    {
        return view("invoice.invoice")->with("products", inStockProduct::all())->with("toners", toner::all());
    }

    public function store(Request $request)
    {

        DB::beginTransaction();

        try {

            $invoice = invoice::create([
                "provider" => $request['provider'],
                "serial_number" => $request['serial_number'],
                "total_price" => 0,
                "help_desk_id" => Auth::user()->helpDesk->id,
            ]);

            $total_price = 0;

            foreach ($request['products'] as $product) {

                $invoice->inStockProducts()->attach($product['id'], ['quantity' => $product['quantity'], 'product_price' => $product['price']]);

                $inStockProduct = inStockProduct::find($product['id']);
                $inStockProduct->quantity += $product['quantity'];
                $inStockProduct->save();

                $total_price += $product['price'] * $product['quantity'];
            }

            foreach ($request['toners_list'] as $toner) {

                $invoice->toners()->attach($toner['id'], ['quantity' => $toner['quantity'], 'toner_price' => $toner['price']]);

                $toner_item = toner::find($toner['id']);
                $toner_item->quantity += $toner['quantity'];
                $toner_item->save();

                $total_price += $toner['price'] * $toner['quantity'];

            }

            $invoice->total_price = $total_price;
            $invoice->save();

        }catch (ValidationException $e){
            DB::rollBack();
            Session::flash("error", $e->getMessage());
            return ['redirect' => back()];
        }

        DB::commit();
        return ['redirect' => route('invoice.index')];

    }

    public function show(invoice $invoice)
    {
        return view('invoice.show')->with('invoice',$invoice);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoice $invoice)
    {
        //
    }

    public function destroy(invoice $invoice)
    {
        $invoice->delete();

        return redirect()->back();
    }
}
