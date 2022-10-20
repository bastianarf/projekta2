<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Schema::create('barang_users', function (Blueprint $table) {
            $table->unsignedInteger('users_id');
            $table->unsignedInteger('barang_id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->primary(['users_id','barang_id']);
            $table->foreign('users_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('barang_id')->references('id')->on('inventaris_barang')->onDelete('CASCADE');
        });
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_users');
    }
}
