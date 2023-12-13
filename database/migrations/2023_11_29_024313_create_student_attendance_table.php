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
        Schema::create('student_attendance', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('class_id');
            $table->smallInteger('student_id');
            $table->date('attendance_date');
            $table->smallInteger('attendance_type')->comment('1: có mặt, 2:vắng, 3 : trễ, 4 : vắng có phép')->default(1);
            $table->smallInteger('create_by')->nullable();
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
        Schema::dropIfExists('student_attendance');
    }
};