<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblKecamatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_kecamatan', function (Blueprint $table) {
            // $table->bigIncrements('id');
            $table->string('kd_kecamatan', 30)->primary();
            $table->string('kd_region', 30)->nullable();
            $table->string('kecamatan', 100)->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('tbl_kecamatan');
    }
}
