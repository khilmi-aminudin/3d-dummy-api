<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlasanPenolakanController extends Controller
{
    public function create(Request $request)
    {
        $responseCode = 200;
        $appsClientId = $request->query("appsClientId");
        
        $data = [
            (object)[
                "nama" => "Dokumen & Data Tidak Valid",
                "code" => "0101",
                "expiredDay" => 180
            ],
            (object)[
                "nama" => "Riwayat Kredit Buruk",
                "code" => "0102",
                "expiredDay" => 180
            ],
            (object)[
                "nama" => "Masuk Daftar Hitam Nasional",
                "code" => "0103",
                "expiredDay" => 180
            ],
            (object)[
                "nama" => "Verifikasi Gagal Dilakukan",
                "code" => "0104",
                "expiredDay" => 180
            ],
            (object)[
                "nama" => "Pihak Manajemen Kurang Kooperatif",
                "code" => "0105 ",
                "expiredDay" => 180
            ]
        ];

        if ($appsClientId == null) {
            $responseCode = 400;
            $data = [
                "message" => "appsClientId tidak boleh kosong"
            ];
        }

        
        return response()->json($data, $responseCode);
    }
}
