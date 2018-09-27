<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePengaduan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_siswa');
            $table->unsignedInteger('id_jenis');
            $table->longText('isi');
            $table->string('foto')->nullable();
            $table->string('hasil')->nullable();
            $table->timestamps();

            $table->foreign('id_siswa')->references('id')->on('siswa');
            $table->foreign('id_jenis')->references('id')->on('layanan_pengaduan');
        });

        \App\Models\Pengaduan::insert([
            'id_siswa' => 1,
            'id_jenis' => 1,
            'isi' => 'Lorem ipsum',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengaduan');
    }
}
