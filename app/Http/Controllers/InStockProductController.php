<?php

namespace App\Http\Controllers;

use App\desktop;
use App\inStockProduct;
use App\ipad;
use App\laptop;
use App\phone;
use App\screen;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class InStockProductController extends Controller
{

    public function index()
    {
        $users = User::where('role', 'employer')->get();

        $laptops = laptop::with('inStockProduct.employer')->paginate(5);
        $desktops = desktop::with('inStockProduct.employer')->paginate(5);
        $screens = screen::with('inStockProduct.employer')->paginate(5);
        $phones = phone::with('inStockProduct.employer')->paginate(5);
        $ipads = ipad::with('inStockProduct.employer')->paginate(5);

        return view("stock.stocks")
            ->with('laptops', $laptops)
            ->with('desktops', $desktops)
            ->with('screens', $screens)
            ->with('phones', $phones)
            ->with('ipads', $ipads)
            ->with('users', $users);
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

        switch ($request['class']) {
            case'laptop' :
                {
                    $data = Validator::make($request->all(), [
                        'class' => ['string', 'required', 'max:255'],
                        'serial_number' => ['string', 'required', 'max:255'],
                        'constructor' => ['string', 'required', 'max:255'],
                        'model' => ['string', 'required', 'max:255'],
                        'status' => ['string', 'required', 'max:255', 'in:bon,neuf,moyen, hors service'],
                        'cpu' => ['string', 'required', 'max:255'],
                        'ram' => ['string', 'required', 'max:255'],
                        'disk' => ['string', 'required', 'max:255'],
                        'screen' => ['string', 'required', 'max:255'],
                        'vc' => ['string', 'required', 'max:255'],
                        'user' => ['string', 'required'],
                    ]);

                    if ($data->fails()) {
                        Session::flash("error", $data->errors());
                        return redirect()->back();
                    }

                    $user = User::find($request['user']);

                    if ($user == null) {

                        $inStockProduct = inStockProduct::create([

                            'zi' => $request['zi'],
                            'invoice' => $request['invoice'],
                            'class' => $request['class'],
                            'serial_number' => $request['serial_number'],
                            'constructor' => $request['constructor'],
                            'model' => $request['model'],
                            'status' => $request['status'],
                            'affected' => 0,

                        ]);

                        $inStockProduct->laptop()->create([
                            'cpu' => $request['cpu'],
                            'vc' => $request['vc'],
                            'ram' => $request['ram'],
                            'disk' => $request['disk'],
                            'screen' => $request['screen'],
                        ]);

                    } else {
                        $inStockProduct = $user->employer->inStockProducts()->create([

                            'zi' => $request['zi'],
                            'invoice' => $request['invoice'],
                            'class' => $request['class'],
                            'serial_number' => $request['serial_number'],
                            'constructor' => $request['constructor'],
                            'model' => $request['model'],
                            'status' => $request['status'],
                            'affected' => 0,

                        ]);

                        $inStockProduct->laptop()->create([
                            'cpu' => $request['cpu'],
                            'vc' => $request['vc'],
                            'ram' => $request['ram'],
                            'disk' => $request['disk'],
                            'screen' => $request['screen'],
                        ]);

                        $inStockProduct->employersHistory()->attach($user->employer->id, ['created_at' => now()->toDateTimeString(), 'updated_at' => now()->toDateTimeString()]);
                    }

                }
                break;
            case'desktop' :
                {
                    $data = Validator::make($request->all(), [
                        'class' => ['string', 'required', 'max:255'],
                        'serial_number' => ['string', 'required', 'max:255'],
                        'constructor' => ['string', 'required', 'max:255'],
                        'model' => ['string', 'required', 'max:255'],
                        'status' => ['string', 'required', 'max:255', 'in:bon,neuf,moyen, hors service'],
                        'cpu' => ['string', 'required', 'max:255'],
                        'ram' => ['string', 'required', 'max:255'],
                        'disk' => ['string', 'required', 'max:255'],
                        'vc' => ['string', 'required', 'max:255'],
                        'user' => ['string', 'required'],
                    ]);

                    if ($data->fails()) {
                        Session::flash("error", $data->errors());
                        return redirect()->back();
                    }

                    $user = User::find($request['user']);

                    if ($user == null) {

                        $inStockProduct = inStockProduct::create([

                            'zi' => $request['zi'],
                            'invoice' => $request['invoice'],
                            'class' => $request['class'],
                            'serial_number' => $request['serial_number'],
                            'constructor' => $request['constructor'],
                            'model' => $request['model'],
                            'status' => $request['status'],
                            'affected' => 0,

                        ]);

                        $inStockProduct->desktop()->create([
                            'cpu' => $request['cpu'],
                            'vc' => $request['vc'],
                            'ram' => $request['ram'],
                            'disk' => $request['disk'],
                        ]);

                    } else {
                        $inStockProduct = $user->employer->inStockProducts()->create([

                            'zi' => $request['zi'],
                            'invoice' => $request['invoice'],
                            'class' => $request['class'],
                            'serial_number' => $request['serial_number'],
                            'constructor' => $request['constructor'],
                            'model' => $request['model'],
                            'status' => $request['status'],
                            'affected' => 0,

                        ]);

                        $inStockProduct->desktop()->create([
                            'cpu' => $request['cpu'],
                            'vc' => $request['vc'],
                            'ram' => $request['ram'],
                            'disk' => $request['disk'],
                        ]);

                        $inStockProduct->employersHistory()->attach($user->employer->id, ['created_at' => now()->toDateTimeString(), 'updated_at' => now()->toDateTimeString()]);
                    }
                }
                break;
            case'screen' :
                {
                    $data = Validator::make($request->all(), [
                        'class' => ['string', 'required', 'max:255'],
                        'serial_number' => ['string', 'required', 'max:255'],
                        'constructor' => ['string', 'required', 'max:255'],
                        'model' => ['string', 'required', 'max:255'],
                        'status' => ['string', 'required', 'max:255', 'in:bon,neuf,moyen, hors service'],
                        'screen' => ['string', 'required', 'max:255'],
                    ]);

                    if ($data->fails()) {
                        Session::flash("error", $data->errors());
                        return redirect()->back();
                    }

                    $user = User::find($request['user']);

                    if ($user == null) {

                        $inStockProduct = inStockProduct::create([

                            'zi' => $request['zi'],
                            'invoice' => $request['invoice'],
                            'class' => $request['class'],
                            'serial_number' => $request['serial_number'],
                            'constructor' => $request['constructor'],
                            'model' => $request['model'],
                            'status' => $request['status'],
                            'affected' => 0,

                        ]);

                        $inStockProduct->screen()->create([
                            'screen' => $request['screen'],
                        ]);

                    } else {
                        $inStockProduct = $user->employer->inStockProducts()->create([

                            'zi' => $request['zi'],
                            'invoice' => $request['invoice'],
                            'class' => $request['class'],
                            'serial_number' => $request['serial_number'],
                            'constructor' => $request['constructor'],
                            'model' => $request['model'],
                            'status' => $request['status'],
                            'affected' => 0,

                        ]);

                        $inStockProduct->screen()->create([
                            'screen' => $request['screen'],
                        ]);

                        $inStockProduct->employersHistory()->attach($user->employer->id, ['created_at' => now()->toDateTimeString(), 'updated_at' => now()->toDateTimeString()]);
                    }
                }
                break;
            case'phone' :
                {
                    $data = Validator::make($request->all(), [
                        'class' => ['string', 'required', 'max:255'],
                        'serial_number' => ['string', 'required', 'max:255'],
                        'constructor' => ['string', 'required', 'max:255'],
                        'model' => ['string', 'required', 'max:255'],
                        'status' => ['string', 'required', 'max:255', 'in:bon,neuf,moyen, hors service'],
                    ]);

                    if ($data->fails()) {
                        Session::flash("error", $data->errors());
                        return redirect()->back();
                    }

                    $user = User::find($request['user']);

                    if ($user == null) {

                        $inStockProduct = inStockProduct::create([

                            'zi' => $request['zi'],
                            'invoice' => $request['invoice'],
                            'class' => $request['class'],
                            'serial_number' => $request['serial_number'],
                            'constructor' => $request['constructor'],
                            'model' => $request['model'],
                            'status' => $request['status'],
                            'affected' => 0,

                        ]);

                        $inStockProduct->phone()->create([

                        ]);

                    } else {
                        $inStockProduct = $user->employer->inStockProducts()->create([

                            'zi' => $request['zi'],
                            'invoice' => $request['invoice'],
                            'class' => $request['class'],
                            'serial_number' => $request['serial_number'],
                            'constructor' => $request['constructor'],
                            'model' => $request['model'],
                            'status' => $request['status'],
                            'affected' => 0,

                        ]);

                        $inStockProduct->phone()->create([
                        ]);

                        $inStockProduct->employersHistory()->attach($user->employer->id, ['created_at' => now()->toDateTimeString(), 'updated_at' => now()->toDateTimeString()]);
                    }
                }
                break;
            case'ipad' :
                {
                    $data = Validator::make($request->all(), [
                        'class' => ['string', 'required', 'max:255'],
                        'serial_number' => ['string', 'required', 'max:255'],
                        'constructor' => ['string', 'required', 'max:255'],
                        'model' => ['string', 'required', 'max:255'],
                        'status' => ['string', 'required', 'max:255', 'in:bon,neuf,moyen, hors service'],
                    ]);

                    if ($data->fails()) {
                        Session::flash("error", $data->errors());
                        return redirect()->back();
                    }

                    $user = User::find($request['user']);

                    if ($user == null) {

                        $inStockProduct = inStockProduct::create([

                            'zi' => $request['zi'],
                            'invoice' => $request['invoice'],
                            'class' => $request['class'],
                            'serial_number' => $request['serial_number'],
                            'constructor' => $request['constructor'],
                            'model' => $request['model'],
                            'status' => $request['status'],
                            'affected' => 0,

                        ]);

                        $inStockProduct->ipad()->create([
                            'dimension' => $request['dimension']
                        ]);

                    } else {
                        $inStockProduct = $user->employer->inStockProducts()->create([

                            'zi' => $request['zi'],
                            'invoice' => $request['invoice'],
                            'class' => $request['class'],
                            'serial_number' => $request['serial_number'],
                            'constructor' => $request['constructor'],
                            'model' => $request['model'],
                            'status' => $request['status'],
                            'affected' => 0,

                        ]);

                        $inStockProduct->ipad()->create([
                            'dimension' => $request['dimension']
                        ]);

                        $inStockProduct->employersHistory()->attach($user->employer->id, ['created_at' => now()->toDateTimeString(), 'updated_at' => now()->toDateTimeString()]);
                    }
                }
                break;
        }

        return redirect()->back();
    }

    public function show(inStockProduct $stock)
    {
        $users = User::where('role', 'employer')->get();

        return view('stock.show')->with("inStockProduct", $stock)->with("users", $users);
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


    public function update(Request $request, inStockProduct $stock)
    {

        switch ($stock->class) {
            case'laptop' :
                {
                    $data = Validator::make($request->all(), [
                        'serial_number' => ['string', 'required', 'max:255'],
                        'constructor' => ['string', 'required', 'max:255'],
                        'model' => ['string', 'required', 'max:255'],
                        'status' => ['string', 'required', 'max:255', 'in:bon,neuf,moyen, hors service'],
                        'cpu' => ['string', 'required', 'max:255'],
                        'ram' => ['string', 'required', 'max:255'],
                        'disk' => ['string', 'required', 'max:255'],
                        'screen' => ['string', 'required', 'max:255'],
                        'vc' => ['string', 'required', 'max:255'],
                        'user' => ['string', 'required'],
                    ]);

                    if ($data->fails()) {
                        Session::flash("error", $data->errors());
                        return redirect()->back();
                    }

                    $stock->zi = $request['zi'];
                    $stock->invoice = $request['invoice'];
                    $stock->serial_number = $request['serial_number'];
                    $stock->constructor = $request['constructor'];
                    $stock->model = $request['model'];
                    $stock->status = $request['status'];

                    $user = User::find($request['user']);

                    if ($user == null) {

                        $stock->employer_id = null;

                    } else {
                        if ($stock->employer_id != $user->employer->id) {

                            $stock->employer_id = $user->employer->id;
                            $stock->employersHistory()->attach($user->employer->id, ['created_at' => now()->toDateTimeString(), 'updated_at' => now()->toDateTimeString()]);

                        }
                    }

                    $stock->save();

                    $stock->laptop->cpu = $request['cpu'];
                    $stock->laptop->vc = $request['vc'];
                    $stock->laptop->ram = $request['ram'];
                    $stock->laptop->disk = $request['disk'];
                    $stock->laptop->screen = $request['screen'];

                    $stock->laptop->save();
                }
                break;
            case'desktop' :
                {
                    $data = Validator::make($request->all(), [
                        'serial_number' => ['string', 'required', 'max:255'],
                        'constructor' => ['string', 'required', 'max:255'],
                        'model' => ['string', 'required', 'max:255'],
                        'status' => ['string', 'required', 'max:255', 'in:bon,neuf,moyen, hors service'],
                        'cpu' => ['string', 'required', 'max:255'],
                        'ram' => ['string', 'required', 'max:255'],
                        'disk' => ['string', 'required', 'max:255'],
                        'vc' => ['string', 'required', 'max:255'],
                        'user' => ['string', 'required'],
                    ]);

                    if ($data->fails()) {
                        Session::flash("error", $data->errors());
                        return redirect()->back();
                    }

                    $stock->zi = $request['zi'];
                    $stock->invoice = $request['invoice'];
                    $stock->serial_number = $request['serial_number'];
                    $stock->constructor = $request['constructor'];
                    $stock->model = $request['model'];
                    $stock->status = $request['status'];

                    $user = User::find($request['user']);

                    if ($user == null) {

                        $stock->employer_id = null;

                    } else {
                        if ($stock->employer_id != $user->employer->id) {

                            $stock->employer_id = $user->employer->id;
                            $stock->employersHistory()->attach($user->employer->id, ['created_at' => now()->toDateTimeString(), 'updated_at' => now()->toDateTimeString()]);

                        }
                    }

                    $stock->save();

                    $stock->desktop->cpu = $request['cpu'];
                    $stock->desktop->vc = $request['vc'];
                    $stock->desktop->ram = $request['ram'];
                    $stock->desktop->disk = $request['disk'];

                    $stock->desktop->save();

                }
                break;
            case'screen' :
                {
                    $data = Validator::make($request->all(), [
                        'serial_number' => ['string', 'required', 'max:255'],
                        'constructor' => ['string', 'required', 'max:255'],
                        'model' => ['string', 'required', 'max:255'],
                        'status' => ['string', 'required', 'max:255', 'in:bon,neuf,moyen, hors service'],
                        'screen' => ['string', 'required', 'max:255'],
                        'user' => ['string', 'required'],
                    ]);

                    if ($data->fails()) {
                        Session::flash("error", $data->errors());
                        return redirect()->back();
                    }

                    $stock->zi = $request['zi'];
                    $stock->invoice = $request['invoice'];
                    $stock->serial_number = $request['serial_number'];
                    $stock->constructor = $request['constructor'];
                    $stock->model = $request['model'];
                    $stock->status = $request['status'];

                    $user = User::find($request['user']);

                    if ($user == null) {

                        $stock->employer_id = null;

                    } else {
                        if ($stock->employer_id != $user->employer->id) {

                            $stock->employer_id = $user->employer->id;
                            $stock->employersHistory()->attach($user->employer->id, ['created_at' => now()->toDateTimeString(), 'updated_at' => now()->toDateTimeString()]);

                        }
                    }

                    $stock->save();

                    $stock->screen->screen = $request['screen'];

                    $stock->screen->save();
                }
                break;
            case'phone' :
                {
                    $data = Validator::make($request->all(), [
                        'serial_number' => ['string', 'required', 'max:255'],
                        'constructor' => ['string', 'required', 'max:255'],
                        'model' => ['string', 'required', 'max:255'],
                        'status' => ['string', 'required', 'max:255', 'in:bon,neuf,moyen, hors service'],
                        'user' => ['string', 'required'],
                    ]);

                    if ($data->fails()) {
                        Session::flash("error", $data->errors());
                        return redirect()->back();
                    }

                    $stock->zi = $request['zi'];
                    $stock->invoice = $request['invoice'];
                    $stock->serial_number = $request['serial_number'];
                    $stock->constructor = $request['constructor'];
                    $stock->model = $request['model'];
                    $stock->status = $request['status'];

                    $user = User::find($request['user']);

                    if ($user == null) {

                        $stock->employer_id = null;

                    } else {
                        if ($stock->employer_id != $user->employer->id) {

                            $stock->employer_id = $user->employer->id;
                            $stock->employersHistory()->attach($user->employer->id, ['created_at' => now()->toDateTimeString(), 'updated_at' => now()->toDateTimeString()]);

                        }
                    }

                    $stock->save();

                    if (isset($request['cession'])) {
                        $stock->phone->cession = 1;
                    } else {
                        $stock->phone->cession = 0;
                    }

                    $stock->phone->save();

                }
                break;
            case'ipad' :
                {
                    $data = Validator::make($request->all(), [
                        'serial_number' => ['string', 'required', 'max:255'],
                        'constructor' => ['string', 'required', 'max:255'],
                        'model' => ['string', 'required', 'max:255'],
                        'status' => ['string', 'required', 'max:255', 'in:bon,neuf,moyen, hors service'],
                        'user' => ['string', 'required'],
                    ]);

                    if ($data->fails()) {
                        Session::flash("error", $data->errors());
                        return redirect()->back();
                    }

                    $stock->zi = $request['zi'];
                    $stock->invoice = $request['invoice'];
                    $stock->serial_number = $request['serial_number'];
                    $stock->constructor = $request['constructor'];
                    $stock->model = $request['model'];
                    $stock->status = $request['status'];

                    $user = User::find($request['user']);

                    if ($user == null) {

                        $stock->employer_id = null;

                    } else {
                        if ($stock->employer_id != $user->employer->id) {

                            $stock->employer_id = $user->employer->id;
                            $stock->employersHistory()->attach($user->employer->id, ['created_at' => now()->toDateTimeString(), 'updated_at' => now()->toDateTimeString()]);

                        }
                    }

                    $stock->save();

                    $stock->ipad->dimension = $request['dimension'];

                    $stock->ipad->save();

                }
                break;
        }

        return redirect()->back();

    }


    public function destroy(inStockProduct $stock)
    {

        $stock->delete();

        return redirect()->route('stock.index');
    }

    public function search(Request $request)
    {

        $inStockProduct = inStockProduct::where('zi', $request['zi_search'])->first();


        return redirect()->route('stock.show', ['stock' => $inStockProduct]);

    }
}
