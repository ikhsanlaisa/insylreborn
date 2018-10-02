<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('status', ['aktif', 'lulus']);
            $table->rememberToken();
            $table->longText('jwt_token')->nullable();
            $table->timestamps();

        });

        User::insert([
            [
                'username' => 'admin',
                'password' => bcrypt('admin'),
                'email' => 'admin@bp2ip.com',
                'status' => 'aktif',
                'created_at' => \Carbon\Carbon::now()
            ],
            [
                'username' => 'alifjafar',
                'email' => 'alif@bp2ip.com',
                'password' => bcrypt('alifjafar'),
                'status' => 'aktif',
                'created_at' => \Carbon\Carbon::now()
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
        Schema::dropIfExists('users');
    }
}
