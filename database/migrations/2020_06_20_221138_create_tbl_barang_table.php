<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_barang', function (Blueprint $table) {
            // $table->bigIncrements('id');
            $table->string('no_resi', 30)->primary();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->string('nama_barang', 100)->nullable();
            $table->text('gambar')->nullable();
            $table->float('berat')->default(0)->nullable();
            $table->float('panjang')->default(0)->nullable();
            $table->text('keterangan')->nullable();
            $table->string('kd_region', 30)->nullable();
            $table->string('status', 30)->nullable();
            $table->timestamps();
            $table->foreign('kd_region')->references('kd_region')->on('tbl_region');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_barang');
    }
}
