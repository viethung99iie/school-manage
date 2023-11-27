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
        Schema::create('exam_schedule', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('class_id');
            $table->smallInteger('subject_id');
            $table->smallInteger('exam_id');
            $table->date('exam_date');
            $table->string('start_time');
            $table->string('end_time');
            $table->string('room');
            $table->string('full_mark');
            $table->string('pass_mark');
            $table->smallInteger('create_by');
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
        Schema::dropIfExists('exam_schedule');
    }
};