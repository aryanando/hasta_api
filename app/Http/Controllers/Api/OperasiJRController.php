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
                ->where('tgl_operasi', $input['tgl_operasi'])->get()->first());

            if ($input['type_penanggung_jawab'] == 'JR_BPJS') {
                $result = Operasi::where('no_rawat', $input['no_rawat'])
                    ->where('tgl_operasi', $input['tgl_operasi'])
                    ->update($this->processJasaraharjaBPJS($forBackup));
            } elseif ($input['type_penanggung_jawab'] == 'JR') {
                $result = Operasi::where('no_rawat', $input['no_rawat'])
                    ->where('tgl_operasi', $input['tgl_operasi'])
                    ->update([
                        "biayaoperator1" => 6000000,
                        "biayaasisten_operator1" => 600000,
                        "biayainstrumen" => 300000,
                        "biayadokter_anestesi" => 2100000,
                        "biayaasisten_anestesi" => 300000,
                        "biaya_omloop" => 150000,
                    ]);
            }

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

            $insert = true;
            $result = $this->processJasaraharjaBPJS($forBackup);
            // $result = $forBackup;
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
    }

    // Private Custom Function ---------------------------------------------------------

    function processJasaraharjaBPJS($data)
    {
        $codingBPJSClaim =
            (($data['biayaoperator1'] ?? 0) +
                ($data['biayaoperator2'] ?? 0) +
                ($data['biayaoperator3'] ?? 0) +
                ($data['biayaasisten_operator1'] ?? 0) +
                ($data['biayaasisten_operator2'] ?? 0) +
                ($data['biayaasisten_operator3'] ?? 0) +
                ($data['biayainstrumen'] ?? 0) +
                ($data['biayadokter_anak'] ?? 0) +
                ($data['biayaperawaat_resusitas'] ?? 0) +
                ($data['biayadokter_anestesi'] ?? 0) +
                ($data['biayaasisten_anestesi'] ?? 0) +
                ($data['biayaasisten_anestesi2'] ?? 0) +
                ($data['biayabidan'] ?? 0) +
                ($data['biayabidan2'] ?? 0) +
                ($data['biayabidan3'] ?? 0) +
                ($data['biayaperawat_luar'] ?? 0) +
                ($data['biayaalat'] ?? 0) +
                ($data['biayasewaok'] ?? 0) +
                ($data['akomodasi'] ?? 0) +
                ($data['bagian_rs'] ?? 0) +
                ($data['biaya_omloop'] ?? 0) +
                ($data['biaya_omloop2'] ?? 0) +
                ($data['biaya_omloop3'] ?? 0) +
                ($data['biaya_omloop4'] ?? 0) +
                ($data['biaya_omloop5'] ?? 0) +
                ($data['biayasarpras'] ?? 0) +
                ($data['biaya_dokter_pjanak'] ?? 0) +
                ($data['biaya_dokter_umum'] ?? 0)) + 20000000;

        return array(
            'biayaoperator1' => $codingBPJSClaim / 100 * 30,
            'biayaoperator2' => 0,
            'biayaoperator3' => 0,
            'biayaasisten_operator1' => ($codingBPJSClaim / 100 * 30) / 100 * 10,
            'biayaasisten_operator2' => 0,
            'biayaasisten_operator3' => 0,
            'biayainstrumen' => ($codingBPJSClaim / 100 * 30) / 100 * 5,
            'biayadokter_anak' => 0,
            'biayaperawaat_resusitas' => 0,
            'biayadokter_anestesi' => ($codingBPJSClaim / 100 * 30) / 100 * 35,
            'biayaasisten_anestesi' => ($codingBPJSClaim / 100 * 30) / 100 * 5,
            'biayaasisten_anestesi2' => 0,
            'biayabidan' => 0,
            'biayabidan2' => 0,
            'biayabidan3' => 0,
            'biayaperawat_luar' => 0,
            'biayaalat' => 0,
            'biayasewaok' => 0,
            'akomodasi' => 0,
            'bagian_rs' => 0,
            'biaya_omloop' => ($codingBPJSClaim / 100 * 30) / 100 * 2.5,
            'biaya_omloop2' => 0,
            'biaya_omloop3' => 0,
            'biaya_omloop4' => 0,
            'biaya_omloop5' => 0,
            'biayasarpras' => 0,
            'biaya_dokter_pjanak' => 0,
            'biaya_dokter_umum' => 0
        );
    }
}
