<?php

namespace App\Http\Controllers;

use App\AssetNameSymbol;
use App\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\DataFromYahooController;

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

    public function getAccountValue(Request $request)
    {
        $id_user = $request->input('id_user');
        $results = DB::table('operations')
            ->select(DB::raw('asset_name, asset_symbol, asset_type, purchase_price, purchase_date, quantity, selling_price, selling_date'))
            ->join('asset_name_symbol', 'asset_name_symbol.id', '=', 'operations.id_asset')
            ->where('operations.id_user', '=', $id_user)
            ->get();
        $array = array();

        foreach ($results as $result) {
            $assetSymbol = $result->asset_symbol;
            $assetName = $result->asset_name;
            $assetType = $result->asset_type;
            $purchasePrice = $result->purchase_price;
            $purchaseDate = $result->purchase_date;
            $quantity = $result->quantity;
            $sellingPrice = $result->selling_price;
            $sellingDate = $result->selling_date;
            $array[] = array(
                'assetSymbol' => $assetSymbol, 'assetName' => $assetName, 'assetType' => $assetType,
                'purchasePrice' => $purchasePrice, 'purchaseDate' => $purchaseDate, 'quantity' => $quantity,
                'sellingPrice' => $sellingPrice, 'sellingDate' => $sellingDate
            );
        }
        return $array;
    }

    public function getAccountValueOld(Request $request)
    {
        $id_user = $request->input('id_user');
        $results = DB::table('operations')
            ->select(DB::raw('sum(operations.quantity) as quantity, asset_symbol'))
            ->join('asset_name_symbol', 'asset_name_symbol.id', '=', 'operations.id_asset')
            ->where('operations.id_user', '=', $id_user)
            ->groupBy('operations.id_asset')
            ->get();
        $array = array();
        foreach ($results as $result) {
            $assetSymbol = $result->asset_symbol;
            $quantity = $result->quantity;
            $price = DataFromYahooController::getPriceAsset($assetSymbol)->content();
            $fixedPrice = substr($price, 10, strlen($price) - 12);
            $array[] = array('assetSymbol' => $assetSymbol, 'quantity' => $quantity, 'price' => $fixedPrice);
        }

        return $array;
    }
}
