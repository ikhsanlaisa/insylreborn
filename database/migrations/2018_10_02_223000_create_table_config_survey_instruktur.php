<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableConfigSurveyInstruktur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_survey_instruktur', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_survey')->nullable();
            $table->unsignedInteger('id_kelas')->nullable();
            $table->unsignedInteger('id_instruktur')->nullable();
            $table->timestamps();


            $table->foreign('id_survey')->references('id')->on('survey')->onDelete('cascade');
            $table->foreign('id_kelas')->references('id')->on('kelas')->onDelete('cascade');
            $table->foreign('id_instruktur')->references('id')->on('instruktur')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('config_survey_instruktur');
    }
}
