<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAngkatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('angkatan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_subdiklat');
            $table->string('kode');
            $table->timestamps();

            $table->foreign('id_subdiklat')->references('id')->on('subdiklat');
        });

        \App\Models\Angkatan::insert([
            'id_subdiklat' => 1,
            'kode' => 'NAA1'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('angkatan');
    }
}
