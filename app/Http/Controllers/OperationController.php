<?php

namespace App\Http\Controllers;

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
        $operation->id_asset = $request->id_asset;
        $operation->purchase_price = $request->purchase_price;
        $operation->quantity = $request->quantity;
        $operation->purchase_date = now();
        $amount = -$request->purchase_price * $request->quantity;
        UsersController::updateMoneyAccount($amount);
        $operation->save();
    }

    public function getAccountValue()
    {
        $id_user = Auth::id(); 
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

    public function sellAsset(Request $request)
    {
        Operation::where('id', $request->input('id'))->update(array('selling_date' => now()));
        Operation::where('id', $request->input('id'))->update(array('selling_price' => $request->input('selling_price')));
        $amount = $request->input('quantity') * $request->input('selling_price');
        UsersController::updateMoneyAccount($amount);
        echo $request->input('quantity');
    }

    public function getActualPriceOfAssets()
    {
        $listOfAssets = $this->sellAssetList();
        $listOfDistinctAssets = [];
        foreach ($listOfAssets as $asset) {
            if (count($listOfDistinctAssets) == 0) {
                $listOfDistinctAssets[] = $asset->asset_symbol;
            } else if (!in_array($asset->asset_symbol, $listOfDistinctAssets)) {
                $listOfDistinctAssets[] = $asset->asset_symbol;
            }
        }
        $assetSymbolPriceList = [];

        foreach ($listOfDistinctAssets as $assetSymbol) {
            $price = DataFromYahooController::getPriceAsset($assetSymbol)->getData()->price;
            $assetSymbolPriceList[] = array('asset_symbol' => $assetSymbol, 'selling_price' => $price);
        }
        return $assetSymbolPriceList;
    }

    public function sellAssetList()
    {
        return DB::table('operations')
            ->join('asset_name_symbol', 'asset_name_symbol.id', '=', 'operations.id_asset')
            ->where('id_user', Auth::id())
            ->whereNull('selling_price')
            ->select('asset_symbol', 'asset_name', 'asset_type', 'purchase_price', 'purchase_date', 'quantity', 'selling_price', 'selling_date', 'operations.id')
            ->get();
    }


    public function sellAssetListSellingPrice()
    {
        $listOfAssetsUser = $this->sellAssetList();
        $listOfAssetsSellingPrice = $this->getActualPriceOfAssets();
        $result = [];

        foreach ($listOfAssetsUser as $assetRegister) {
            foreach ($listOfAssetsSellingPrice as $assetSellingPrice) {
                if ($assetRegister->asset_symbol == $assetSellingPrice['asset_symbol']) {
                    $result[] = array(
                        'id' => $assetRegister->id, 'asset_symbol' => $assetRegister->asset_symbol, 'selling_price' => $assetSellingPrice['selling_price'],
                        'asset_name' => $assetRegister->asset_name, 'asset_type' => $assetRegister->asset_type,
                        'purchase_price' => $assetRegister->purchase_price, 'purchase_date' => $assetRegister->purchase_date,
                        'quantity' => $assetRegister->quantity,
                    );
                }
            }
        }
        return json_encode($result);
    }

    public function getProfit() 
    {
        $queryResult = DB::table('operations')
            ->join('asset_name_symbol', 'asset_name_symbol.id', '=', 'operations.id_asset')
            ->where('id_user', Auth::id())
            ->whereNotNull('selling_price')
            ->select('asset_symbol', 'asset_name', 'asset_type', 'purchase_price', 'purchase_date', 'quantity', 'selling_price', 'selling_date', 'operations.id')
            ->get();
        $result = 0;
        foreach ($queryResult as $row) {
            $result += $row->quantity * ($row->selling_price - $row->purchase_price);
        }
        return $result;
    }
}
