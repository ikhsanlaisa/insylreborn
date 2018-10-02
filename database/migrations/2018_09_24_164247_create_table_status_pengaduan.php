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
            $table->enum('status', ['tersubmit','on progress','selesai']);
            $table->timestamps();
        });

        \App\Models\StatusPengaduan::insert([
            [
                'status' => 'tersubmit'
            ],
            [
                'status' => 'on progress'
            ],
            [
                'status' => 'selesai'
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
