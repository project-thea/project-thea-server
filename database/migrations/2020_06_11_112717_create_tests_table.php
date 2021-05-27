<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
			
			$table->string('name');
			$table->text('details');
			
            $table->timestamps();
            
			//Name of person who did the test
			$table->text('done_by');
			$table->unsignedBigInteger('driver_id');
			$table->unsignedBigInteger('trip_id');
			
			
			// $table->timestamp('created_at')->useCurrent();
			// $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tests');
    }
}
