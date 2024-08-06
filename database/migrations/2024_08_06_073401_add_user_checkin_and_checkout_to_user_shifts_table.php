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
        Schema::table('user_shifts', function (Blueprint $table) {
            $table->dateTime('check_out')->after('valid_date_end')->nullable();
            $table->dateTime('check_in')->after('valid_date_end')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_shifts', function (Blueprint $table) {
            //
        });
    }
};
