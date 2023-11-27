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
        Schema::create('marks', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('class_id');
            $table->smallInteger('subject_id');
            $table->smallInteger('exam_id');
            $table->smallInteger('student_id');
            $table->smallInteger('class_work')->default(0);
            $table->smallInteger('home_work')->default(0);
            $table->smallInteger('test_work')->default(0);
            $table->smallInteger('exam')->default(0);
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
        Schema::dropIfExists('marks');
    }
};