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
            $table->foreignId('disease_id')->constrained('diseases'); // foreign key column 'disease_id'
            $table->foreignId('subject_id')->constrained('subjects'); // foreign key column 'subject_id'
            $table->date('test_date');
            $table->string('status', 9); //unknown, negative, positive
            $table->date('status_update_date');
            $table->string('created_with')->nullable(); // user, app
            $table->string('updated_with')->nullable(); //user. app
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('test_date');
            $table->index('status_update_date');
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
