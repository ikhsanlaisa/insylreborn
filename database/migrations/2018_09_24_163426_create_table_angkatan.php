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
            $table->date('periode_awal');
            $table->date('periode_akhir');
            $table->timestamps();

            $table->foreign('id_subdiklat')->references('id')->on('subdiklat')->onDelete('cascade')->onUpdate('cascade');
        });

        \App\Models\Angkatan::insert([
            'id_subdiklat' => 1,
            'kode' => 'NAA1',
            'periode_awal' => \Carbon\Carbon::createFromDate(2018,9,2,'+07:00'),
            'periode_akhir' => \Carbon\Carbon::createFromDate(2020,9,2,'+07:00'),
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
