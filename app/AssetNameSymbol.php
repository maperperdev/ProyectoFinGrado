<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;


class AssetNameSymbol extends Model
{
    protected $table = 'asset_name_symbol';
    public $timestamps = false;

    public function getOperationsById($id_user)
    {
    }
}
