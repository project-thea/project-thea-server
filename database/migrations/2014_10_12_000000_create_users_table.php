<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('first_name', 55);
            $table->string('middle_name', 55)->nullable();
            $table->string('last_name', 55);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('nationality', 55);
            $table->date('date_of_birth');
            $table->string('user_mobile', 20);
            $table->string('next_of_kin', 55);
            $table->string('next_of_kin_mobile', 20);
            $table->string('created_with', 5)->nullable();
            $table->string('updated_with', 5)->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->index('first_name');
            $table->index('last_name');
            $table->index('user_mobile');
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
}
