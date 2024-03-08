<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_units', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('unit_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('unit_id')->references('id')->on('unit_translations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_units');
    }
};
