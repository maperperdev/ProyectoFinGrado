<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('operations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_user')->unsigned();
            $table->bigInteger('id_asset')->unsigned();
            $table->float('purchase_price');
            $table->date('purchase_date');
            $table->float('quantity');
            $table->float('selling_price')->nullable();
            $table->date('selling_date')->nullable();
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_asset')->references('id')->on('asset_name_symbol');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operations');
    }
}
