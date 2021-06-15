<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Operation extends Model
{
    public $timestamps = false;

    public static function getOperationsById($id)
    {
        return Operation::where('id_user', $id)->get();
    }
}
