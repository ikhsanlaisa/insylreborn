<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableInstruktur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instruktur', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nip')->unique();
            $table->string('nama');
            $table->enum('gender', ['L','P'])->nullable();
            $table->string('alamat');
            $table->string('kontak');
            $table->timestamps();
        });

        \App\Models\Instruktur::insert([
            'nip' => '16.57.00001',
            'nama' => 'A. Nurwahidah',
            'gender' => 'P',
            'alamat' => 'Bandung',
            'kontak' => '112413133'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instruktur');
    }
}
