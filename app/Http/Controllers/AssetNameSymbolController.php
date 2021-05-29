<?php

namespace App\Http\Controllers;

use App\AssetNameSymbol;

class AssetNameSymbolController extends Controller
{

    public static function listAllStocks()
    {
        return AssetNameSymbol::where('asset_type', '1')->orderBy('asset_name')->get();
    }

    public static function listAllCryptos()
    {
        return AssetNameSymbol::where('asset_type', '2')->orderBy('asset_name')->get();
    }

    public function listAllStocksForBuying()
    {
        return view('stocks', [
            "stocks" => $this->listAllStocks()
        ]);
    }

    public function listAllStocksForGraphics()
    {
        return view('makeGraphics', [
            "stocks" => $this->listAllStocks()
        ]);
    }
}
