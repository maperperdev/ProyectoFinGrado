<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;


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

    public function addMoneyToAccount(Request $request)
    {
        $this->updateMoneyAccount($request->input('money'));
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

    public function getMoneyAccount()
    {
        $money = DB::table('users')->where('id', Auth::id())->get('money_account');
        return $money[0]->money_account;
    }

    public function getUserData()
    {
        $user = DB::table('users')->where('id', Auth::id())->get();
        return response()->json($user[0]);
    }

    public function updateUser(Request $request)
    {
        $user = User::find(Auth::id());
        $updatedFields = 0;

        if ($request->input('name') !== null) {
            $user->name = $request->input('name');
            $updatedFields++;
        }
        if ($request->input('email') !== null) {
            $user->email = $request->input('email');
            $updatedFields++;
        }
        if ($request->input('password') !== null) {
            $user->password = Hash::make($request->input('password'));
            $updatedFields++;
        }
        if ($updatedFields > 0) {
            $user->save();
        }
    }
}
