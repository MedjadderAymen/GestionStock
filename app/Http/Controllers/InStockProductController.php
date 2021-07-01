<?php

namespace App\Http\Controllers;

use App\inStockProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InStockProductController extends Controller
{

    public function index()
    {
        return view("stock.stocks")->with('stocks', inStockProduct::all());
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
        $data = Validator::make($request->all(), [
            'material' => ['string', 'required', 'max:255'],
            'quantity' => ['required', 'numeric', 'max:255'],
        ]);

        if ($data->fails()) {
            $error['message'] = "validation error";
            return response()->json($error, 404);
        }

        $stock = inStockProduct::firstOrCreate(
            ['material' => $request['material']],
            ['material' => $request['material'], 'quantity' => $request['quantity']]
        );

        $stock->quantity += $request['quantity'];

        $stock->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\inStockProduct $inStockProduct
     * @return \Illuminate\Http\Response
     */
    public function show(inStockProduct $inStockProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\inStockProduct $inStockProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(inStockProduct $inStockProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\inStockProduct $inStockProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, inStockProduct $inStockProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\inStockProduct $inStockProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(inStockProduct $inStockProduct)
    {
        //
    }
}
