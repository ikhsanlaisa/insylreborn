<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePertanyaanSurvey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pertanyaan_survey', function (Blueprint $table) {
            $table->increments('id');
            $table->string('isi');
            $table->unsignedInteger('id_tipe_jawaban');
            $table->unsignedInteger('id_survey');
            $table->timestamps();

            $table->foreign('id_tipe_jawaban')->references('id')->on('tipe_jawaban')->onDelete('cascade');
            $table->foreign('id_survey')->references('id')->on('survey')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pertanyaan_survey');
    }
}
