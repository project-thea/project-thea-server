<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name', 55);
            $table->string('email')->unique();
            $table->string('nationality', 55);
            $table->date('date_of_birth');
            $table->string('phone', 20);
            $table->string('next_of_kin', 55);
            $table->string('next_of_kin_phone', 20);
            $table->uuid('unique_id')->nullable();
            $table->string('id_number', 40);
            $table->string('id_type', 30);
            $table->string('created_with', 5)->nullable();
            $table->string('updated_with', 5)->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();

            
            $table->index('name');
            $table->index('phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}
