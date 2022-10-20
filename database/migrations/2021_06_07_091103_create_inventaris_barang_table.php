<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventarisBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventaris_barang', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('users_id');
            $table->string('kode_barang',255)->unique();
            $table->string('nama_barang',150);
            $table->unsignedInteger('qty_barang');
            $table->string('ruangan_barang',50);
            $table->string('merk_barang',255);
            $table->string('warna_barang',255);
            $table->string('kondisi_barang',255);
            $table->string('catatan_barang',255)->nullable();
            $table->timestamps();
            $table->foreign('users_id')->references('id')->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventaris_barang');
    }
}
