<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKdRegionColumnToTblKelurahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_kelurahan', function (Blueprint $table) {
            //
            $table->string('kd_region', 30)->nullable();
            $table->foreign('kd_region')->references('kd_region')->on('tbl_region');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_kelurahan', function (Blueprint $table) {
            //
        });
    }
}
