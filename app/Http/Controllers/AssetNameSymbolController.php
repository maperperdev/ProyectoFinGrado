<?php

namespace App\Http\Controllers;

use App\AssetNameSymbol;
use Illuminate\Http\Request;
use PDO;
use DB;

class AssetNameSymbolController extends Controller
{
    //
    public function getAssetById($id)
    {
    }

    // public function listAll() {
    //     $listAllAssets = DB::table('asset_name_symbols')->orderBy('asset_name')->get();
    //     return view('hello', [
    //         "assets" => $listAllAssets
    //     ]);
    // }

    public function listAllStocks()
    {
        return AssetNameSymbol::where('asset_type', '1')->orderBy('asset_name')->get();
    }

    public function listAllStocksForBuying()
    {
        return view('stocks', [
            "stocks" => $this->listAllStocks()
        ]);
    }

    public function listAllCryptos()
    {
        $listAllCryptos = AssetNameSymbol::where('asset_type', '2')->orderBy('asset_name')->get();
        return view('cryptos', [
            "cryptos" => $listAllCryptos
        ]);
    }

    public function listAllStocksForGraphics()
    {
        return view('makeGraphics', [
            "stocks" => $this->listAllStocks()
        ]);
    }
}
