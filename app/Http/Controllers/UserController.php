<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index()
    {
        $users = User::where('role', 'employer')->paginate(25);

        return view('employer.employers')->with("users", $users);
    }

    public function create()
    {
        return view('employer.employer');
    }

    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'numeric', 'unique:users'],
            'function' => ['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
        ]);

        if ($data->fails()) {
            $error['message'] = "validation error";
            return response()->json($error, 404);
        }

        $user = User::create([
            'name' => $request['first_name'] . ' ' . $request['last_name'],
            'email' => $request['email'],
            'phone_number' => $request['phone_number'],
            'role' => "employer",
            'password' => Hash::make("password"),
        ]);

        $user->employer()->create([
            'function' => $request['function'],
            'department' => $request['department'],
            'company' => $request['company'],
        ]);

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit(User $user)
    {
        return view('employer.update')->with('user', $user);
    }

    public function update(Request $request, User $user)
    {
        $data = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',],
            'phone_number' => ['required', 'numeric'],
            'function' => ['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
        ]);

        if ($data->fails()) {
            $error['message'] = "validation error";
            return response()->json($data->errors(), 404);
        }

        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->phone_number = $request['phone_number'];
        $user->save();

        $user->employer()->updateOrCreate([], [
            'function' => $request['function'],
            'department' => $request['department'],
            'company' => $request['company'],
        ]);

        return redirect()->route('user.edit', ['user' => $user]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index');
    }
}
