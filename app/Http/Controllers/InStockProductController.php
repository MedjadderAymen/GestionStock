<?php

namespace App\Http\Controllers;

use App\desktop;
use App\inStockProduct;
use App\ipad;
use App\laptop;
use App\phone;
use App\screen;
use App\site;
use App\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class InStockProductController extends Controller
{

    public function __construct()
    {

        $this->middleware(['helpDesk'])->except(['index', 'show', 'search']);

    }

    public function index()
    {
        $users = User::where('role', 'employer')->has('employer')->get();
        $sites = site::all();

        $laptops = laptop::with('inStockProduct.employer')->paginate(25);
        $desktops = desktop::with('inStockProduct.employer')->paginate(25);
        $screens = screen::with('inStockProduct.employer')->paginate(25);
        $phones = phone::with('inStockProduct.employer')->paginate(25);
        $ipads = ipad::with('inStockProduct.employer')->paginate(25);

        return view("stock.stocks")
            ->with('laptops', $laptops)
            ->with('desktops', $desktops)
            ->with('screens', $screens)
            ->with('phones', $phones)
            ->with('ipads', $ipads)
            ->with('sites', $sites)
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

        DB::beginTransaction();

        try {

            switch ($request['class']) {
                case'laptop' :
                    {
                        $data = Validator::make($request->all(), [
                            'class' => ['string', 'required', 'max:255'],
                            'serial_number' => ['string', 'required', 'max:255'],
                            'constructor' => ['string', 'required', 'max:255'],
                            'model' => ['string', 'required', 'max:255'],
                            'status' => ['string', 'required', 'max:255', 'in:bon,neuf,moyen,hors service'],
                            'cpu' => ['string', 'required', 'max:255'],
                            'ram' => ['string', 'required', 'max:255'],
                            'disk' => ['string', 'required', 'max:255'],
                            'screen' => ['string', 'required', 'max:255'],
                            'vc' => ['string', 'required', 'max:255'],
                            'user' => ['string', 'required'],
                            'location_line_one' => ['string', 'sometimes'],
                            'location_line_two' => ['string', 'sometimes'],
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
                                'date_affectation' => $request['date_affectation'],
                                'affected' => 0,

                            ]);

                            $inStockProduct->laptop()->create([
                                'cpu' => $request['cpu'],
                                'vc' => $request['vc'],
                                'ram' => $request['ram'],
                                'disk' => $request['disk'],
                                'screen' => $request['screen'],
                            ]);

                            $inStockProduct->employersHistory()->attach($user->employer->id, ['date_affectation' => $request['date_affectation'], 'created_at' => now()->toDateTimeString(), 'updated_at' => now()->toDateTimeString()]);

                            $user->active = 1;
                            $user->save();
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
                            'status' => ['string', 'required', 'max:255', 'in:bon,neuf,moyen,hors service'],
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
                                'date_affectation' => $request['date_affectation'],
                                'affected' => 0,

                            ]);

                            $inStockProduct->desktop()->create([
                                'cpu' => $request['cpu'],
                                'vc' => $request['vc'],
                                'ram' => $request['ram'],
                                'disk' => $request['disk'],
                            ]);

                            $inStockProduct->employersHistory()->attach($user->employer->id, ['date_affectation' => $request['date_affectation'], 'created_at' => now()->toDateTimeString(), 'updated_at' => now()->toDateTimeString()]);

                            $user->active = 1;
                            $user->save();
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
                            'status' => ['string', 'required', 'max:255', 'in:bon,neuf,moyen,hors service'],
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
                                'date_affectation' => $request['date_affectation'],
                                'affected' => 0,

                            ]);

                            $inStockProduct->screen()->create([
                                'screen' => $request['screen'],
                            ]);

                            $inStockProduct->employersHistory()->attach($user->employer->id, ['date_affectation' => $request['date_affectation'], 'created_at' => now()->toDateTimeString(), 'updated_at' => now()->toDateTimeString()]);

                            $user->active = 1;
                            $user->save();

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
                            'status' => ['string', 'required', 'max:255', 'in:bon,neuf,moyen,hors service'],
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
                                'date_affectation' => $request['date_affectation'],
                                'affected' => 0,

                            ]);

                            $inStockProduct->phone()->create([
                            ]);

                            $inStockProduct->employersHistory()->attach($user->employer->id, ['date_affectation' => $request['date_affectation'], 'created_at' => now()->toDateTimeString(), 'updated_at' => now()->toDateTimeString()]);

                            $user->active = 1;
                            $user->save();
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
                            'status' => ['string', 'required', 'max:255', 'in:bon,neuf,moyen,hors service'],
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
                                'date_affectation' => $request['date_affectation'],
                                'affected' => 0,

                            ]);

                            $inStockProduct->ipad()->create([
                                'dimension' => $request['dimension']
                            ]);

                            $inStockProduct->employersHistory()->attach($user->employer->id, ['date_affectation' => $request['date_affectation'], 'created_at' => now()->toDateTimeString(), 'updated_at' => now()->toDateTimeString()]);

                            $user->active = 1;
                            $user->save();
                        }
                    }
                    break;
            }

            $site = site::find($request['site']);

            if ($site != null) {

                $location = $site->locations()->create([
                    'location_line_one'=>$request['location_line_one'],
                    'location_line_two'=>$request['location_line_two'],
                ]);

                $inStockProduct->location_id = $location->id;
                $inStockProduct->save();

            }

        }catch (ValidationException $e){

            DB::rollBack();

            Session::flash("error", $e->getMessage());
            return redirect()->back();

        }

        DB::commit();
        return redirect()->back();
    }

    public function show(inStockProduct $stock)
    {
        $users = User::where('role', 'employer')->has('employer')->get();
        $sites=site::all();

        return view('stock.show')->with("inStockProduct", $stock)->with("users", $users)->with('sites',$sites);
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

        DB::beginTransaction();

        try {

            switch ($stock->class) {
                case'laptop' :
                    {
                        $data = Validator::make($request->all(), [
                            'serial_number' => ['string', 'required', 'max:255'],
                            'constructor' => ['string', 'required', 'max:255'],
                            'model' => ['string', 'required', 'max:255'],
                            'status' => ['string', 'required', 'max:255', 'in:bon,neuf,moyen,hors service'],
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
                            $stock->date_affectation = null;

                        } else {

                            $stock->date_affectation = $request['date_affectation'];

                            if ($stock->employer_id != $user->employer->id) {

                                $stock->employer_id = $user->employer->id;
                                $stock->employersHistory()->attach($user->employer->id, ['date_affectation' => $request['date_affectation'], 'created_at' => now()->toDateTimeString(), 'updated_at' => now()->toDateTimeString()]);

                            }

                            $user->active = 1;
                            $user->save();
                        }

                        $stock->save();

                        $stock->laptop->cpu = $request['cpu'];
                        $stock->laptop->vc = $request['vc'];
                        $stock->laptop->ram = $request['ram'];
                        $stock->laptop->disk = $request['disk'];
                        $stock->laptop->screen = $request['screen'];

                        if (isset($request['bag'])) {
                            $stock->laptop->bag = 1;
                        } else {
                            $stock->laptop->bag = 0;
                        }

                        $stock->laptop->save();
                    }
                    break;
                case'desktop' :
                    {
                        $data = Validator::make($request->all(), [
                            'serial_number' => ['string', 'required', 'max:255'],
                            'constructor' => ['string', 'required', 'max:255'],
                            'model' => ['string', 'required', 'max:255'],
                            'status' => ['string', 'required', 'max:255', 'in:bon,neuf,moyen,hors service'],
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
                            $stock->date_affectation = null;

                        } else {

                            $stock->date_affectation = $request['date_affectation'];

                            if ($stock->employer_id != $user->employer->id) {

                                $stock->employer_id = $user->employer->id;
                                $stock->employersHistory()->attach($user->employer->id, ['date_affectation' => $request['date_affectation'], 'created_at' => now()->toDateTimeString(), 'updated_at' => now()->toDateTimeString()]);

                            }

                            $user->active = 1;
                            $user->save();
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
                            'status' => ['string', 'required', 'max:255', 'in:bon,neuf,moyen,hors service'],
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
                            $stock->date_affectation = null;

                        } else {

                            $stock->date_affectation = $request['date_affectation'];

                            if ($stock->employer_id != $user->employer->id) {

                                $stock->employer_id = $user->employer->id;
                                $stock->employersHistory()->attach($user->employer->id, ['date_affectation' => $request['date_affectation'], 'created_at' => now()->toDateTimeString(), 'updated_at' => now()->toDateTimeString()]);

                            }

                            $user->active = 1;
                            $user->save();

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
                            'status' => ['string', 'required', 'max:255', 'in:bon,neuf,moyen,hors service'],
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
                            $stock->date_affectation = null;

                        } else {

                            $stock->date_affectation = $request['date_affectation'];

                            if ($stock->employer_id != $user->employer->id) {

                                $stock->employer_id = $user->employer->id;
                                $stock->employersHistory()->attach($user->employer->id, ['date_affectation' => $request['date_affectation'], 'created_at' => now()->toDateTimeString(), 'updated_at' => now()->toDateTimeString()]);

                            }

                            $user->active = 1;
                            $user->save();
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
                            'status' => ['string', 'required', 'max:255', 'in:bon,neuf,moyen,hors service'],
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
                            $stock->date_affectation = null;

                        } else {

                            $stock->date_affectation = $request['date_affectation'];

                            if ($stock->employer_id != $user->employer->id) {

                                $stock->employer_id = $user->employer->id;
                                $stock->employersHistory()->attach($user->employer->id, ['date_affectation' => $request['date_affectation'], 'created_at' => now()->toDateTimeString(), 'updated_at' => now()->toDateTimeString()]);

                            }

                            $user->active = 1;
                            $user->save();

                        }

                        $stock->save();

                        $stock->ipad->dimension = $request['dimension'];

                        $stock->ipad->save();

                    }
                    break;
            }

            $site = site::find($request['site']);

            if ($site != null) {

                $stock->location()->delete();

                $location = $site->locations()->create([
                    'location_line_one'=>$request['location_line_one'],
                    'location_line_two'=>$request['location_line_two'],
                ]);

                $stock->location_id = $location->id;
                $stock->save();

            }else{
                $stock->location()->delete();
            }

        }catch (ValidationException $e){

            DB::rollBack();
            Session::flash("error", $e->getMessage());
            return redirect()->back();

        }

        DB::commit();

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

        if ($inStockProduct === null) {

            Session::flash("info", "ce Zi n'éxiste pas");

            return redirect()->back();
        }


        return redirect()->route('stock.show', ['stock' => $inStockProduct]);

    }

    public function restore(inStockProduct $stock)
    {

        DB::beginTransaction();

        try {

            $user = $stock->employer->user;

            switch ($stock->class) {
                case 'laptop':

                    $stock->employer_id = null;
                    $stock->date_affectation = null;
                    $stock->save();

                    $laptop = $stock->laptop;

                    return view('stock.restitution')
                        ->with('laptop', $laptop)
                        ->with('class', $stock->class)
                        ->with('user', $user);

                case 'desktop':

                    $stock->employer_id = null;
                    $stock->date_affectation = null;
                    $stock->save();

                    $desktop = $stock->desktop;

                    return view('stock.restitution')
                        ->with('desktop', $desktop)
                        ->with('class', $stock->class)
                        ->with('user', $user);

                case 'screen':

                    $stock->employer_id = null;
                    $stock->date_affectation = null;
                    $stock->save();

                    $screen = $stock->screen;

                    return view('stock.restitution')
                        ->with('screen', $screen)
                        ->with('class', $stock->class)
                        ->with('user', $user);
                case 'phone':
                    $phone = $stock->phone;

                    if (!$phone->cession) {
                        $stock->employer_id = null;
                        $stock->date_affectation = null;
                        $stock->save();
                    }

                    return view('stock.restitution')
                        ->with('phone', $phone)
                        ->with('class', $stock->class)
                        ->with('user', $user);
                case 'ipad':

                    $stock->employer_id = null;
                    $stock->date_affectation = null;
                    $stock->save();

                    $ipad = $stock->ipad;

                    return view('stock.restitution')
                        ->with('ipad', $ipad)
                        ->with('class', $stock->class)
                        ->with('user', $user);
            }

        }catch (ValidationException $e){

            DB::rollBack();

            Session::flash("error", $e->getMessage());
            return redirect()->back();

        }

        DB::commit();

        return redirect()->back();


    }
}
