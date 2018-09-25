<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableKelas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_angkatan');
            $table->string('kode');
            $table->string('nama');
            $table->timestamps();

            $table->foreign('id_angkatan')->references('id')->on('angkatan');
        });

        \App\Models\Kelas::insert([
            'id_angkatan' => 1,
            'kode' => 'NAA',
            'nama' => 'AK47'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelas');
    }
}
