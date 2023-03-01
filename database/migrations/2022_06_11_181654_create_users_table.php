<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('userid')->autoIncrement();
            $table->char('firstname', 30);
            $table->char('surname', 30);
            $table->string('username', 20)->unique();
            $table->char('password', 60); //hashed bcrypt password 60 chars long
            $table->string('email', 100)->unique();
            $table->char('userrole', 1)->default('1'); // 1 for user, 2 for administrator
            $table->boolean('has_company')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
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
};
