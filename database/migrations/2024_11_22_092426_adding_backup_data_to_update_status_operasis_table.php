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
        Schema::table('update_status_operasis', function (Blueprint $table) {
            $table->double('biayaoperator1')->nullable();
            $table->double('biayaoperator2')->nullable();
            $table->double('biayaoperator3')->nullable();
            $table->double('biayaasisten_operator1')->nullable();
            $table->double('biayaasisten_operator2')->nullable();
            $table->double('biayaasisten_operator3')->nullable();
            $table->double('biayainstrumen')->nullable();
            $table->double('biayadokter_anak')->nullable();
            $table->double('biayaperawaat_resusitas')->nullable();
            $table->double('biayadokter_anestesi')->nullable();
            $table->double('biayaasisten_anestesi')->nullable();
            $table->double('biayaasisten_anestesi2')->nullable();
            $table->double('biayabidan')->nullable();
            $table->double('biayabidan2')->nullable();
            $table->double('biayabidan3')->nullable();
            $table->double('biayaperawat_luar')->nullable();
            $table->double('biayaalat')->nullable();
            $table->double('biayasewaok')->nullable();
            $table->double('akomodasi')->nullable();
            $table->double('bagian_rs')->nullable();
            $table->double('biaya_omloop')->nullable();
            $table->double('biaya_omloop2')->nullable();
            $table->double('biaya_omloop3')->nullable();
            $table->double('biaya_omloop4')->nullable();
            $table->double('biaya_omloop5')->nullable();
            $table->double('biayasarpras')->nullable();
            $table->double('biaya_dokter_pjanak')->nullable();
            $table->double('biaya_dokter_umum')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('update_status_operasis', function (Blueprint $table) {
            //
        });
    }
};
