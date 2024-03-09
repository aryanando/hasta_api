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
        Schema::create('update_shifts', function (Blueprint $table) {
            $table->id();
            $table->text('update_shift_reason');
            $table->bigInteger('update_shift_backup_id')->unsigned();
            $table->foreign('update_shift_backup_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('update_shifts');
    }
};
