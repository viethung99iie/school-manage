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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->String('id_student')->nullable();
            $table->String('id_card')->nullable();
            $table->String('gender')->nullable();
            $table->integer('class_id')->nullable();
            $table->integer('parent_id')->nullable()->constrained();
            $table->String('native')->nullable();
            $table->String('nation')->nullable();
            $table->String('religion')->nullable();
            $table->date('date_card')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->date('date_admission')->nullable();
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
        Schema::dropIfExists('students');
    }
};