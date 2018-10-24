<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tim1')->unsigned();
            $table->integer('tim2')->unsigned();
            $table->string('lokasi');
            $table->string('date_time');
            $table->integer('olahraga_id')->unsigned();
            $table->timestamps();

            $table->foreign('tim1')->references('id')->on('kelas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tim2')->references('id')->on('kelas')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('jadwal');
    }
}
