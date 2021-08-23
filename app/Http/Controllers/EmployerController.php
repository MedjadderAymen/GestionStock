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

    }

    public function create()
    {

    }

    public function store(Request $request)
    {
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

    public function edit(User $user)
    {

    }

    public function update(Request $request, User $User)
    {


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
