<?php

namespace App\Http\Controllers;

use App\inStockProduct;
use App\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function __construct()
    {

        $this->middleware('helpDesk')->except(['index', 'show']);

    }

    public function index()
    {
        $users = User::where('role', 'employer')->paginate(25);

        return view('employer.employers')->with("users", $users);
    }

    public function create()
    {
        $departments = ['Direction Générale',
            'Direction Industrielle',
            'Direction Ventes et Marketing',
            'Direction Finances et Comptabilité',
            'Direction Commerciale et Distribution',
            'Direction des Ressources Humaines',
            'Direction Médicale',
            'Direction Market Access et Affaires Règlementaires'];

        return view('employer.employer')->with("departments", $departments);
    }

    public function store(Request $request)
    {

        DB::beginTransaction();

        try {

            $data = Validator::make($request->all(), [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['sometimes', 'nullable', 'string', 'email', 'max:255', 'unique:users'],
                'phone_number' => ['sometimes', 'nullable', 'unique:users'],
                'windows_username' => ['sometimes', 'nullable', 'string', 'max:255'],
                'function' => ['required', 'string', 'max:255'],
                'department' => ['required', 'string', 'max:255'],
                'company' => ['required', 'string', 'max:255'],
            ]);

            if ($data->fails()) {
                $error['message'] = "validation error";
                return response()->json($data->errors(), 404);
            }

            $user = User::create([
                'name' => $request['first_name'] . ' ' . $request['last_name'],
                'email' => $request['email'],
                'windows_username' => $request['windows_username'],
                'phone_number' => $request['phone_number'],
                'role' => "employer",
                'password' => Hash::make("password"),
            ]);

            if ($request['sap'] === "on") {
                $user->sap = 1;
                $user->username = $request['username'];

                $user->save();
            }

            $user->employer()->create([
                'function' => $request['function'],
                'department' => $request['department'],
                'company' => $request['company'],
            ]);

        } catch (ValidationException $e) {
            DB::rollBack();
            dd($e->getMessage());
        }

        DB::commit();

        return redirect()->route('user.index');
    }


    public function show(User $user)
    {

        if (isset($user->employer)) {

            $laptops = $user->employer->inStockProducts->where('class', 'laptop');
            $desktops = $user->employer->inStockProducts->where('class', 'desktop');
            $screens = $user->employer->inStockProducts->where('class', 'screen');
            $phones = $user->employer->inStockProducts->where('class', 'phone');
            $ipads = $user->employer->inStockProducts->where('class', 'ipad');

            return view('employer.show')
                ->with('user', $user)
                ->with('laptops', $laptops)
                ->with('desktops', $desktops)
                ->with('screens', $screens)
                ->with('phones', $phones)
                ->with('ipads', $ipads);

        } else {

            $departments = ['Direction Générale',
                'Direction Industrielle',
                'Direction Ventes et Marketing',
                'Direction Finances et Comptabilité',
                'Direction Commerciale et Distribution',
                'Direction des Ressources Humaines',
                'Direction Médicale',
                'Direction Market Access et Affaires Règlementaires'];

            return view('employer.update')->with('user', $user)->with('departments', $departments);

        }
    }

    public function edit(User $user)
    {
        $departments = ['Direction Générale',
            'Direction Industrielle',
            'Direction Ventes et Marketing',
            'Direction Finances et Comptabilité',
            'Direction Commerciale et Distribution',
            'Direction des Ressources Humaines',
            'Direction Médicale',
            'Direction Market Access et Affaires Règlementaires'];

        return view('employer.update')->with('user', $user)->with('departments', $departments);
    }

    public function update(Request $request, User $user)
    {
        DB::beginTransaction();

        try {

            $data = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['sometimes', 'nullable', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user),],
                'phone_number' => ['sometimes', 'nullable', Rule::unique('users')->ignore($user),],
                'windows_username' => ['sometimes', 'nullable', 'string', 'max:255'],
                'function' => ['required', 'string', 'max:255'],
                'department' => ['required', 'string', 'max:255'],
                'company' => ['required', 'string', 'max:255'],
            ]);

            if ($data->fails()) {
                $error['message'] = "validation error";
                return response()->json($data->errors(), 404);
            }

            $user->name = $request['name'];
            $user->windows_username = $request['windows_username'];
            $user->email = $request['email'];
            $user->phone_number = $request['phone_number'];

            if ($request['sap'] === "on") {
                $user->sap = 1;
                $user->username = $request['username'];
            } else {
                $user->sap = 0;
                $user->username = null;
            }

            $user->save();

            $user->employer()->updateOrCreate([], [
                'function' => $request['function'],
                'department' => $request['department'],
                'company' => $request['company'],
            ]);

        } catch (ValidationException $e) {

            DB::rollBack();

            Session::flash("error", $e->getMessage());
            return redirect()->back();


        }

        DB::commit();

        return redirect()->route('user.edit', ['user' => $user]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index');
    }

    public function print(User $user)
    {

        $laptops = $user->employer->inStockProducts->where('class', 'laptop');
        $desktops = $user->employer->inStockProducts->where('class', 'desktop');
        $screens = $user->employer->inStockProducts->where('class', 'screen');
        $phones = $user->employer->inStockProducts->where('class', 'phone');
        $ipads = $user->employer->inStockProducts->where('class', 'ipad');

        return view('employer.release')
            ->with('user', $user)
            ->with('laptops', $laptops)
            ->with('desktops', $desktops)
            ->with('screens', $screens)
            ->with('phones', $phones)
            ->with('ipads', $ipads);

    }

    public function restore(User $user)
    {

        DB::beginTransaction();

        try {

            $laptops = $user->employer->inStockProducts->where('class', 'laptop');
            $desktops = $user->employer->inStockProducts->where('class', 'desktop');
            $screens = $user->employer->inStockProducts->where('class', 'screen');
            $phones = $user->employer->inStockProducts->where('class', 'phone');
            $ipads = $user->employer->inStockProducts->where('class', 'ipad');


            foreach ($user->employer->inStockProducts as $detachData) {

                if ($detachData->class === "phone" && $detachData->phone->cession) {
                    continue;
                }

                $detachData->employer_id = null;
                $detachData->date_affectation = null;
                $detachData->save();

            }

            $user->active = 0;
            $user->save();


        } catch (ValidationException $e) {
            DB::rollBack();

            Session::flash("error", $e->getMessage());
            return redirect()->back();
        }

        DB::commit();

        return view('employer.restitution')
            ->with('user', $user)
            ->with('laptops', $laptops)
            ->with('desktops', $desktops)
            ->with('screens', $screens)
            ->with('phones', $phones)
            ->with('ipads', $ipads);

    }

    public function search(Request $request)
    {

        $user = User::where('name', 'like', '%' . $request['name'] . '%')->first();

        if ($user === null) {

            Session::flash("info", "ce Employé n'éxiste pas");

            return redirect()->back();
        }

        return redirect()->route('user.show', ['user' => $user]);

    }

}
