<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('scheduled_date');
            $table->unsignedInteger('patient_id')->nullable();
            $table->unsignedInteger('doctor_id')->nullable();

            $table->foreign('patient_id')->references('id')->on('patients')->onUpdate('cascade');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onUpdate('cascade');

            $table->boolean('is_confirmed')->default(false);

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
        Schema::dropIfExists('schedules');
    }
}
