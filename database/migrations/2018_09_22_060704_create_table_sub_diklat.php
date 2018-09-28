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
        Schema::create('subdiklat', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_diklat');
            $table->string('kode');
            $table->string('nama');
            $table->timestamps();

            $table->foreign('id_diklat')->references('id')->on('diklat')->onDelete('cascade')->onUpdate('cascade');
        });

        \App\Models\SubDiklat::insert([
            'id_diklat' => 1,
            'kode' => 'NAAX',
            'nama' => 'Subdiklat X'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subdiklat');
    }
}
