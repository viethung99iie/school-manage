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
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->String('gender')->nullable();
            $table->String('id_card')->nullable();
            $table->String('occupation')->nullable();
            $table->String('address')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->String('nation')->nullable();
            $table->date('date_card')->nullable();
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
        Schema::dropIfExists('parents');
    }
};