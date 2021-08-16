<?php

namespace App\Http\Controllers;

use App\inStockProduct;
use App\toner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TonerController extends Controller
{

    public function index()
    {
        return view("toner.toners")->with('toners', toner::all());
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

        $data = Validator::make($request->only('reference','color','quantity'), [
            'reference' => ['string', 'required', 'max:255'],
            'color' => ['required', 'string', 'in:Magenta,Cyan,Jaune,Noir'],
            'quantity' => ['required', 'numeric', 'max:255'],
        ]);

        if ($data->fails()) {
            $error['message'] = "validation error";
            return response()->json($data->errors(), 404);
        }

        $toner = toner::firstOrCreate(
            ['reference' => $request['reference'], 'color'=>$request['color']],
            ['reference' => $request['reference'], 'quantity' => 0, 'color' => $request['color']]
        );

        $toner->quantity += $request['quantity'];

        $toner->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\toner  $toner
     * @return \Illuminate\Http\Response
     */
    public function show(toner $toner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\toner  $toner
     * @return \Illuminate\Http\Response
     */
    public function edit(toner $toner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\toner  $toner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, toner $toner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\toner  $toner
     * @return \Illuminate\Http\Response
     */
    public function destroy(toner $toner)
    {
        //
    }
}
