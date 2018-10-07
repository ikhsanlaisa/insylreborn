<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStatusPengaduan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_pengaduan', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status', ['TERSUBMIT','ON PROGRESS','SELESAI']);
            $table->timestamps();
        });

        \App\Models\StatusPengaduan::insert([
            [
                'status' => 'TERSUBMIT'
            ],
            [
                'status' => 'ON PROGRESS'
            ],
            [
                'status' => 'SELESAI'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_pengaduan');
    }
}
