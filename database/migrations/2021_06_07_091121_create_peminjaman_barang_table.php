<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeminjamanBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman_barang', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->unsignedInteger('users_id');
            $table->string('nama_peminjam',255);
            $table->string('kode_barang',255)->unique();
            $table->string('nama_barang',255);
            $table->unsignedInteger('qty_barang');
            $table->string('merk_barang',255);
            $table->string('warna_barang',255);
            $table->string('ruangan_barang',50);
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali');
            $table->string('keterangan', 255)->nullable();
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
        Schema::dropIfExists('peminjaman_barang');
    }
}
