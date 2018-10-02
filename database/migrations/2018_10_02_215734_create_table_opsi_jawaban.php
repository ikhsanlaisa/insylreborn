<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOpsiJawaban extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opsi_jawaban', function (Blueprint $table) {
            $table->integer('id');
            $table->string('nama');
            $table->unsignedInteger('id_tipe_jawaban');

            $table->primary(['id', 'id_tipe_jawaban']);

            $table->foreign('id_tipe_jawaban')->references('id')->on('tipe_jawaban');
        });

        \App\Models\OpsiJawaban::insert([
            [
                'id' => 11,
                'nama' => 'Tidak Setuju',
                'id_tipe_jawaban' => 1
            ],
            [
                'id' => 12,
                'nama' => 'Kurang Setuju',
                'id_tipe_jawaban' => 1
            ],
            [
                'id' => 13,
                'nama' => 'Cukup Setuju',
                'id_tipe_jawaban' => 1
            ],
            [
                'id' => 14,
                'nama' => 'Setuju',
                'id_tipe_jawaban' => 1
            ],
            [
                'id' => 15,
                'nama' => 'Sangat Setuju',
                'id_tipe_jawaban' => 1
            ],

            [
                'id' => 21,
                'nama' => 'Tidak Puas',
                'id_tipe_jawaban' => 2
            ],
            [
                'id' => 22,
                'nama' => 'Kurang Puas',
                'id_tipe_jawaban' => 2
            ],
            [
                'id' => 23,
                'nama' => 'Cukup Puas',
                'id_tipe_jawaban' => 2
            ],
            [
                'id' => 24,
                'nama' => 'Puas',
                'id_tipe_jawaban' => 2
            ],
            [
                'id' => 25,
                'nama' => 'Sangat Puas',
                'id_tipe_jawaban' => 2
            ],


        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opsi_jawaban');
    }
}
