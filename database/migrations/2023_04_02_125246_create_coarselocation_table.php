<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoarselocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coarselocation', function (Blueprint $table) {
            $table->id();
            $table->integer('subject_id');
            $table->string('latitude')->index();
            $table->string('longitude')->index();
            $table->uuid('unique_id')->index();
            $table->dateTime('date_time');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->index('subject_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coarselocation');
    }
}
