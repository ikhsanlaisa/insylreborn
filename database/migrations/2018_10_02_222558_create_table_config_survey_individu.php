<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableConfigSurveyIndividu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_survey_individu', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_diklat')->nullable();
            $table->unsignedInteger('id_subdiklat')->nullable();
            $table->unsignedInteger('id_angkatan')->nullable();
            $table->unsignedInteger('id_kelas')->nullable();
            $table->unsignedInteger('id_siswa')->nullable();
            $table->timestamps();


            $table->foreign('id_diklat')->references('id')->on('diklat')->onDelete('cascade');
            $table->foreign('id_subdiklat')->references('id')->on('subdiklat')->onDelete('cascade');
            $table->foreign('id_angkatan')->references('id')->on('angkatan')->onDelete('cascade');
            $table->foreign('id_kelas')->references('id')->on('kelas')->onDelete('cascade');
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
        Schema::dropIfExists('config_survey_individu');
    }
}
