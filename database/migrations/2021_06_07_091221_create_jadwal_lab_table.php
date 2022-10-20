<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJadwalLabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_lab', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('users_id');
            $table->string('ruang_lab');
            $table->string('kelas');
            $table->date('tgl_penggunaan');
            $table->time('waktu_penggunaan_mulai');
            $table->time('waktu_penggunaan_akhir');
            $table->string('nama_matpel');
            $table->string('nama_guru');
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
        Schema::dropIfExists('jadwal_lab');
    }
}
