<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_tipe');
            $table->unsignedInteger('id_layanan')->nullable();
            $table->string('nip');
            $table->string('nama');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_tipe')->references('id')->on('tipe_admin')->onDelete(null);
            $table->foreign('id_layanan')->references('id')->on('layanan_pengaduan');
        });

        \App\Models\Admin::insert([
           'id_user' => 1,
           'id_tipe' => 1,
           'nip' => '12345678',
           'nama' => 'Super Admin'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin');
    }
}
