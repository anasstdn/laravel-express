<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblRouteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_route', function (Blueprint $table) {
            // $table->bigIncrements('id');
            $table->string('kd_route', 30)->primary();
            $table->string('dari_kota', 100)->nullable();
            $table->string('ke_kota', 100)->nullable();
            $table->float('tarif')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_route');
    }
}
