<?php

namespace App\Http\Controllers;

use App\employer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmployerController extends Controller
{

    public function index()
    {
        $users=User::all()->where('role','employer');

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
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
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

        return redirect()->route('employer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\employer $employer
     * @return \Illuminate\Http\Response
     */
    public function show(employer $employer)
    {
        //
    }


    public function edit(employer $employer)
    {
        return view('employer.update')->with('employer', $employer);
    }

    public function update(Request $request, employer $employer)
    {
        $data = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
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

        $employer->user->first_name = $request['first_name'];
        $employer->user->last_name = $request['last_name'];
        $employer->user->email = $request['email'];
        $employer->user->phone_number = $request['phone_number'];
        $employer->user->save();

        $employer->function = $request['function'];
        $employer->department = $request['department'];
        $employer->company = $request['company'];
        $employer->save();

        return redirect()->route('employer.edit', ['employer' => $employer]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\employer $employer
     * @return \Illuminate\Http\Response
     */
    public function destroy(employer $employer)
    {
        //
    }
}
