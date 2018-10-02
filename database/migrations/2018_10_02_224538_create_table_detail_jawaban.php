<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDetailJawaban extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_jawaban', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_jawaban_survey');
            $table->unsignedInteger('id_pertanyaan');
            $table->string('isi');
            $table->unsignedInteger('id_opsi_jawaban');
            $table->timestamps();

            $table->foreign('id_jawaban_survey')->references('id')->on('jawaban_survey')->onDelete('cascade');
            $table->foreign('id_pertanyaan')->references('id')->on('pertanyaan_survey')->onDelete('cascade');
            $table->foreign('id_opsi_jawaban')->references('id')->on('opsi_jawaban')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_jawaban');
    }
}
