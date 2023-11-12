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
        Schema::create('class_subject_time', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('class_id');
            $table->smallInteger('subject_id');
            $table->smallInteger('week_id');
            $table->string('start_time');
            $table->string('end_time');
            $table->string('room');
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
        Schema::dropIfExists('class_subject_time');
    }
};
