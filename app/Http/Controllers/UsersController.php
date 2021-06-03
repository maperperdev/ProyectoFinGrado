<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public static function updateMoneyAccount($amount)
    {
        // $amount = $request->input('amount');
        if ($amount > 0) {
            DB::table('users')->where('id', Auth::id())->increment('money_account', $amount);
        } else {
            $amount *= -1;
            DB::table('users')->where('id', Auth::id())->decrement('money_account', $amount);
        }
    }
}
