<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableJawabanSurvey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawaban_survey', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_survey')->nullable();
            $table->unsignedInteger('id_config_instruktur')->nullable();
            $table->unsignedInteger('id_siswa');
            $table->timestamps();

            $table->foreign('id_survey')->references('id')->on('survey')->onDelete('cascade');
            $table->foreign('id_siswa')->references('id')->on('siswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jawaban_survey');
    }
}
