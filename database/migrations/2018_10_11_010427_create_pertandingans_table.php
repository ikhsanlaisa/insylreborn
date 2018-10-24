<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePertandingansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pertandingan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jadwal_id')->unsigned();
            $table->string('keterangan');
            $table->integer('tim1')->unsigned();
            $table->integer('tim2')->unsigned();
            $table->integer('cabor')->unsigned();
            $table->string('score');
            $table->string('lokasi');
            $table->timestamps();

            $table->foreign('jadwal_id')->references('id')->on('jadwal')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tim1')->references('id')->on('kelas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tim2')->references('id')->on('kelas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cabor')->references('id')->on('olahraga')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pertandingan');
    }
}
