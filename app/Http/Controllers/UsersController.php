<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\DB;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function getLoggedUser()
    {
        $user = Auth::user();
        return view('list-users', [
            'user' => $user
        ]);
    }

    public function getUserId()
    {
        return Auth::id();
    }
}
