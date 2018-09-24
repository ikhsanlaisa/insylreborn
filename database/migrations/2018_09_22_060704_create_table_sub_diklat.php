<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSubDiklat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_diklat', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('diklat_id');
            $table->string('kode');
            $table->string('nama');
            $table->timestamps();

            $table->foreign('diklat_id')->references('id')->on('diklat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_diklat');
    }
}
