<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\RegistrasiPeriksa;
use App\Models\simrs\Operasi;
use App\Models\UpdateStatusOperasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OperasiJRController extends Controller
{
    public function index()
    {
        $result = Operasi::whereMonth('tgl_operasi', Carbon::now())->get();
        return response()->json([
            'success' => true,
            'message' => 'Get data operasi successfully.',
            'data' => $result,
        ], 200);
    }

    public function getByNoRM($no_rkm_medis)
    {
        $result = Pasien::with(['regPeriksa'  => function ($query) {
            return $query->has('dataOperasi')->with(['dataOperasi.dataUpdateOperasi.dataPetugas', 'dataPenjab', 'dataDokter']);
        }])->where('no_rkm_medis', '=', $no_rkm_medis)->get();
        return response()->json([
            'success' => true,
            'message' => 'Get data operasi successfully.',
            'data' => $result,
        ], 200);
    }

    public function getByPenjab($kd_pj)
    {
        $result = RegistrasiPeriksa::with(['dataOperasi', 'dataPenjab', 'dataDokter', 'pasien'])
            ->where('kd_pj', '=', $kd_pj)
            ->has('dataOperasi')
            ->whereMonth('tgl_registrasi', Carbon::now())
            ->whereYear('tgl_registrasi', Carbon::now())
            ->get();
        return response()->json([
            'success' => true,
            'message' => 'Get data operasi successfully.',
            'data' => $result,
        ], 200);
    }

    public function putOperasi(Request $request)
    {

        $input = $request->input();
        $checkUpdateStatus = UpdateStatusOperasi::where('no_rawat', $input['no_rawat'])
            ->where('tanggal_operasi', $input['tgl_operasi'])->get();
        if (count($checkUpdateStatus) == 0) {
            $forBackup = (Operasi::where('no_rawat', $input['no_rawat'])
                ->where('tgl_operasi', $input['tgl_operasi'])->get())->first();
            $result = Operasi::where('no_rawat', $input['no_rawat'])
                ->where('tgl_operasi', $input['tgl_operasi'])
                ->update($input);

            $insert = UpdateStatusOperasi::create([
                'no_rawat' => $input['no_rawat'],
                'tanggal_operasi' => $input['tgl_operasi'],
                'updated_by' => Auth::id(),
                'biayaoperator1' => $forBackup['biayaoperator1'],
                'biayaoperator2' => $forBackup['biayaoperator2'],
                'biayaoperator3' => $forBackup['biayaoperator3'],
                'biayaasisten_operator1' => $forBackup['biayaasisten_operator1'],
                'biayaasisten_operator2' => $forBackup['biayaasisten_operator2'],
                'biayaasisten_operator3' => $forBackup['biayaasisten_operator3'],
                'biayainstrumen' => $forBackup['biayainstrumen'],
                'biayadokter_anak' => $forBackup['biayadokter_anak'],
                'biayaperawaat_resusitas' => $forBackup['biayaperawaat_resusitas'],
                'biayadokter_anestesi' => $forBackup['biayadokter_anestesi'],
                'biayaasisten_anestesi' => $forBackup['biayaasisten_anestesi'],
                'biayaasisten_anestesi2' => $forBackup['biayaasisten_anestesi2'],
                'biayabidan' => $forBackup['biayabidan'],
                'biayabidan2' => $forBackup['biayabidan2'],
                'biayabidan3' => $forBackup['biayabidan3'],
                'biayaperawat_luar' => $forBackup['biayaperawat_luar'],
                'biayaalat' => $forBackup['biayaalat'],
                'biayasewaok' => $forBackup['biayasewaok'],
                'akomodasi' => $forBackup['akomodasi'],
                'bagian_rs' => $forBackup['bagian_rs'],
                'biaya_omloop' => $forBackup['biaya_omloop'],
                'biaya_omloop2' => $forBackup['biaya_omloop2'],
                'biaya_omloop3' => $forBackup['biaya_omloop3'],
                'biaya_omloop4' => $forBackup['biaya_omloop4'],
                'biaya_omloop5' => $forBackup['biaya_omloop5'],
                'biayasarpras' => $forBackup['biayasarpras'],
                'biaya_dokter_pjanak' => $forBackup['biaya_dokter_pjanak'],
                'biaya_dokter_umum' => $forBackup['biaya_dokter_umum'],
            ]);
            if ($forBackup and $insert) {
                return response()->json([
                    'success' => true,
                    'message' => 'Update data operasi successfully.',
                    'data' => $result,
                ], 200);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => 'Update data operasi unsuccessfully.',
                    'data' => $result,
                ], 200);
            }
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Update data operasi unsuccessfully Data Operasi Pernah Diupdate.',
                'data' => [],
            ], 200);
        }


        // return response()->json([
        //     'success' => true,
        //     'message' => 'Update data operasi unsuccessfully Data Operasi Pernah Diupdate.',
        //     'data' => count($checkUpdateStatus),
        // ], 200);
    }
}
