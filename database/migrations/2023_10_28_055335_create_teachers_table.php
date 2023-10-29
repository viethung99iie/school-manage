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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->String('id_teacher')->nullable();
            $table->String('id_card')->nullable();
            $table->String('gender')->nullable();
            $table->integer('class_id')->nullable();
            $table->String('native')->nullable();
            $table->String('address')->nullable();
            $table->String('nation')->nullable();
            $table->String('qualification')->nullable();
            $table->String('work_exp')->nullable();
            $table->String('position')->nullable();
            $table->integer('department_id')->nullable();
            $table->String('religion')->nullable();
            $table->date('date_card')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->date('date_join')->nullable();
            $table->integer('marital_status')->default(0)->comment('0: không xác định, 1: độc thân, 2: đã kết hôn');
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
        Schema::dropIfExists('teachers');
    }
};
