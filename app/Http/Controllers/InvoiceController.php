<?php

namespace App\Http\Controllers;

use App\inStockProduct;
use App\invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public function index()
    {
        return view("invoice.invoices")->with("invoices",invoice::all());
    }

    public function create()
    {
        return view("invoice.invoice")->with("products",inStockProduct::all());
    }

    public function store(Request $request)
    {
        return  $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoice $invoice)
    {
        //
    }
}
