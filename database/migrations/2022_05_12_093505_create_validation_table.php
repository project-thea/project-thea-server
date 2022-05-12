<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValidationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('validation', function (Blueprint $table) {
            $table->id();
			$table->integer('hotspot_id');
			$table->datetime('date_time');
			$table->integer('num_exposed');
			$table->integer('num_infected');
			$table->float('trx_rate', 5, 3);
            $table->timestamps();
			
			$table->unique('hotspot_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('validation');
    }
}
