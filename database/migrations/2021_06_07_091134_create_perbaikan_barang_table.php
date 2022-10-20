<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerbaikanBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perbaikan_barang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('users_id');
            $table->string('kode_barang',255)->unique();
            $table->string('nama_barang',150);
            $table->unsignedInteger('qty_barang');
            $table->string('ruangan_barang',50);
            $table->string('jenis_kerusakan',255);
            $table->string('keterangan_barang',255)->nullable();
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
        Schema::dropIfExists('perbaikan_barang');
    }
}
