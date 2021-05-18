<?php

namespace App\Http\Controllers;

use App\AssetNameSymbol;
use App\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OperationController extends Controller
{
    //
    public function create()
    {
        $listStocks = AssetNameSymbolController::listAllStocks();
        return view(
            'operation-form',
            [
                'stocks' => $listStocks
            ]
        );
    }

    public function store(Request $request)
    {
        $operation = new Operation();
        $operation->id_user = Auth::id();
        $companySymbol = $request->companySymbol;
        $operation->id_asset =  AssetNameSymbol::where('asset_symbol', $companySymbol)->get('id')->first()->id;
        $operation->purchase_price = $request->price;
        $operation->quantity = $request->quantity;
        $operation->purchase_date = now();
        $operation->save();
    }
}
