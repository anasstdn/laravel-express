<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPengirimanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pengiriman', function (Blueprint $table) {
            // $table->bigIncrements('id');
            // $table->timestamps();
            $table->string('kd_pengiriman', 30)->primary();
            $table->string('no_resi', 30)->nullable();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->string('dari_kota', 100)->nullable();
            $table->string('ke_kota', 100)->nullable();
            $table->date('tgl_delivered')->nullable();
            $table->string('nama_penerima', 100)->nullable();
            $table->text('alamat_penerima')->nullable();
            $table->float('tarif')->default(0)->nullable();
            $table->string('status', 30)->nullable();
            $table->unsignedBigInteger('id_kurir')->nullable();
            $table->timestamps();
            $table->foreign('no_resi')->references('no_resi')->on('tbl_barang');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_kurir')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_pengiriman');
    }
}
