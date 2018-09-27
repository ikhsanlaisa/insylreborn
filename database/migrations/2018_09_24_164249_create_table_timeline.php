<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTimeline extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timeline', function (Blueprint $table) {
            $table->unsignedInteger('id_pengaduan');
            $table->unsignedInteger('id_status')->default('1');
            $table->dateTime('waktu');
            $table->timestamps();

            $table->primary(['id_pengaduan', 'id_status']);
            $table->foreign('id_pengaduan')->references('id')->on('pengaduan')->onDelete('cascade');
            $table->foreign('id_status')->references('id')->on('status_pengaduan');
        });

        \App\Models\Timeline::insert([
            [
                'id_pengaduan' => 1,
                'id_status' => 1,
                'waktu' => \Carbon\Carbon::now(),
            ],
            [
                'id_pengaduan' => 1,
                'id_status' => 2,
                'waktu' => \Carbon\Carbon::now(),
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
        Schema::dropIfExists('timeline');
    }
}
