<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LdapUserController extends Controller
{
    public function index()
    {
        $users = User::get();

        dd($users);
    }
}
