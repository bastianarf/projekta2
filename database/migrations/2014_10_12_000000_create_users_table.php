<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_lengkap',150);
            $table->string('nis_nip',255)->unique();
            $table->enum('role',['Admin', 'Kepala Laboratorium', 'Guru', 'Siswa']);
            $table->string('ruang_kalab',150)->nullable();
            $table->string('kelas',20)->nullable();
            $table->string('mapel_guru',150)->nullable();
            $table->string('email',150);
            $table->string('password',255);
            $table->boolean('cek')->default('1');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
