<?php

namespace App\Http\Controllers;

use App\Models\User_shifts;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserStatisticController extends Controller
{
    //
    public function show()
    {
        $absensi3 = User_shifts::where('user_id', '=', Auth::id())
            ->with('shifts')
            ->where(function ($query) {
                $nows = Carbon::now();
                $query->whereYear('valid_date_start', '=', $nows->format('Y'))
                    ->whereMonth('valid_date_start', '=', $nows->format('m'))
                    ->orWhereMonth('valid_date_start', '=', $nows->subMonth()->format('m'))
                    ->orWhereMonth('valid_date_start', '=', $nows->subMonth(1)->format('m'));
            })
            ->get();

        $now = Carbon::now();
        if ($now->format('m') == '08') {
            $currentMonth = User_shifts::where('user_id', '=', Auth::id())
                ->whereYear('valid_date_start', '=', $now->format('Y'))
                ->whereMonth('valid_date_start', '=', $now->format('m'))
                ->whereDay('valid_date_start', '<', $now->format('d'))
                ->whereDay('valid_date_start', '>', '05')
                ->with('shifts')
                ->get();
        } else {
            $currentMonth = User_shifts::where('user_id', '=', Auth::id())
                ->whereYear('valid_date_start', '=', $now->format('Y'))
                ->whereMonth('valid_date_start', '=', $now->format('m'))
                ->whereDay('valid_date_start', '<', $now->format('d'))
                ->with('shifts')
                ->get();
        }

        $lastMonth = User_shifts::where('user_id', '=', Auth::id())
            ->whereYear('valid_date_start', '=', $now->format('Y'))
            ->whereMonth('valid_date_start', '=', $now->subMonth()->format('m'))
            ->with('shifts')
            ->get();

        $data = array(
            'threeMonthShift' => $absensi3,
            'currentMonth' => $currentMonth,
            'lastMonth' => $lastMonth,
            'currentMonthRating' => round($this->monthRating($currentMonth)['rating'], 2),
            'currentMonthLate' => $this->monthRating($currentMonth)['jumlahTerlambat'],
            'countShifts' => count($currentMonth),
            'lastMonthRating' => $this->monthRating($lastMonth),
        );
        return response()->json([
            'success' => true,
            'message' => 'Get User Statistic Sucessfull',
            'data' => $data,
        ], 200);
    }

    function monthRating($currentMonth)
    {
        $totalRating = 0;
        $jumlahShifts = 0;
        $jumlahTerlambat = 0;
        foreach ($currentMonth as $data) {
            $jumlahShifts++;
            $userCheckIn = new Carbon($data['check_in']);
            $checkIn = new Carbon($data['shifts']['check_in']);
            if ($data['check_in'] == NULL) {
                $totalRating += 0;
            } else {
                $masuk = new Carbon($userCheckIn->format('h:i:s'));
                $batasMasuk = new Carbon($checkIn->format('h:i:s'));
                if ($batasMasuk->gt($masuk)) {
                    $totalRating += 5;
                } else {
                    if ($masuk->diffInMinutes($batasMasuk) < 50 and $masuk->diffInMinutes($batasMasuk) > 0) {
                        $totalRating += 5 - $masuk->diffInMinutes($batasMasuk) / 10;
                    } elseif ($masuk->diffInMinutes($batasMasuk) <= 0) {
                        $totalRating += 5;
                    }
                    if ($masuk->diffInMinutes($batasMasuk) > 10) {
                        $jumlahTerlambat += 1;
                    }
                }
            }
        }
        return array(
            'rating' => $totalRating / $jumlahShifts,
            'jumlahTerlambat' => $jumlahTerlambat,
        );
    }
}
