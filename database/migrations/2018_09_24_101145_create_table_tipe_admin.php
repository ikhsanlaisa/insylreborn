<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTipeAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipe_admin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipe');
            $table->timestamps();
        });

        \App\Models\TipeAdmin::insert([
            'tipe' => 'Super Admin'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipe_admin');
    }
}
