<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblKelurahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_kelurahan', function (Blueprint $table) {
            // $table->bigIncrements('id');
            $table->string('kd_kelurahan', 30)->primary();
            $table->string('kd_kecamatan', 30)->nullable();
            $table->string('kelurahan', 100)->nullable();
            $table->timestamps();
            $table->foreign('kd_kecamatan')->references('kd_kecamatan')->on('tbl_kecamatan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_kelurahan');
    }
}
