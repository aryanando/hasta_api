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
        Schema::create('user_salary_receipt', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun');
            $table->integer('bulan');
            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->integer('gaji_pokok')->nullable();
            $table->integer('bpjs_tk')->nullable();
            $table->integer('bpjs_4p')->nullable();
            $table->integer('t_keluarga')->nullable();
            $table->integer('thr')->nullable();
            $table->integer('jaspel')->nullable();
            $table->integer('pot_bpjs_tk')->nullable();
            $table->integer('pot_bpjs_4p')->nullable();
            $table->integer('pot_bpjs_1p')->nullable();
            $table->integer('pot_t_keluarga')->nullable();
            $table->integer('pot_thr')->nullable();
            $table->integer('pot_s_koperasi')->nullable();
            $table->integer('pot_yatim_ppni')->nullable();
            $table->integer('pot_bon')->nullable();
            $table->integer('pot_jajan_kop')->nullable();
            $table->integer('pot_tagihan_kasir')->nullable();
            $table->integer('pot_cicilan_kop')->nullable();
            $table->integer('pot_kinerja')->nullable();
            $table->integer('pot_pph21')->nullable();
            $table->integer('jumlah_gaji')->nullable();
            $table->integer('jumlah_potongan')->nullable();
            $table->integer('jumlah_diterima')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_salary_receipt');
    }
};
