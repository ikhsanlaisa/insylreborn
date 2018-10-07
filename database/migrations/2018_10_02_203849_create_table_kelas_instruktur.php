<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableKelasInstruktur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas_instruktur', function (Blueprint $table) {
            $table->unsignedInteger('id_kelas');
            $table->unsignedInteger('id_instruktur');
            $table->string('mapel');
            $table->timestamps();

            $table->primary(['id_kelas','id_instruktur']);
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
        Schema::dropIfExists('kelas_instruktur');
    }
}
