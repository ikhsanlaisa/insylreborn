<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrasi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('profil_id')->unsigned();
            $table->integer('olahraga_id')->unsigned();
            $table->string('file')->nullable();
            $table->timestamps();

            $table->foreign('profil_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('olahraga_id')->references('id')->on('olahraga')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrasi');
    }
}
