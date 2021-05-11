<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\DB;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function getLoggedUser() {
        // $user = DB::table('users')->where('id', 1)->first();
        // $user = DB::table('users')->where('id', $id)->first();
        $user = Auth::user();
        return view('list-users', [
            'user' => $user
            ]);
    }
}
