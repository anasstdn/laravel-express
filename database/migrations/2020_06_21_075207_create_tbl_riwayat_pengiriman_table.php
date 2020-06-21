<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblRiwayatPengirimanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_riwayat_pengiriman', function (Blueprint $table) {
            // $table->bigIncrements('id');
            $table->string('kd_pre_pengiriman', 30)->primary();
            $table->string('no_resi', 30)->nullable();
            $table->string('dari_kota', 100)->nullable();
            $table->string('ke_kota', 100)->nullable();
            $table->string('kecamatan', 100)->nullable();
            $table->string('kelurahan', 100)->nullable();
            $table->string('current_city', 100)->nullable();
            $table->date('tgl_pengiriman')->nullable();
            $table->float('tarif')->default(0)->nullable();
            $table->string('status', 30)->nullable();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->unsignedBigInteger('id_kurir')->nullable();
            $table->string('nama_penerima', 100)->nullable();
            $table->text('alamat_penerima')->nullable();
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
        Schema::dropIfExists('tbl_riwayat_pengiriman');
    }
}
