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
        Schema::create('klaim_rujukans', function (Blueprint $table) {
            $table->id();
            $table->text('nama_pasien');
            $table->text('no_reg_periksa');
            $table->bigInteger('biaya');
            $table->text('nama_perujuk');
            $table->bigInteger('perujuk_id')->unsigned()->nullable();
            $table->bigInteger('petugas_rm')->unsigned();
            $table->bigInteger('petugas_kasir')->unsigned()->nullable();
            $table->text('no_hp');
            $table->text('bukti_foto_serahterima')->nullable();
            $table->text('keterangan');
            $table->foreign('perujuk_id')->references('id')->on('users');
            $table->foreign('petugas_rm')->references('id')->on('users');
            $table->foreign('petugas_kasir')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('klaim_rujukans');
    }
};
