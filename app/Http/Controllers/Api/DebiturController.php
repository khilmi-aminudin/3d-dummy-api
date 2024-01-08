<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class DebiturController extends Controller
{
    public function index(Request $request)
    {
        $responseCode = 400;
        $jenisDebiturPerorangan = "Perorangan";
        $jenisDebiturNonPerorangan = "Non-Perorangan";

        $appsClientId = $request->query("appsClientId");
        $jenisDebitur = $request->query("jenisDebitur");
        $value = $request->query("value");
        
        $data = [];
        
        if ($appsClientId == null) {
            $responseCode = 400;
            $data = [
                "message" => "appsClientId tidak boleh kosong"
            ];
        }

                
        if ($jenisDebitur == null) {
            $responseCode = 400;
            $data = [
                "message" => "jenisDebitur tidak boleh kosong"
            ];
        }

                
        if ($value == null) {
            $responseCode = 400;
            $data = [
                "message" => "value tidak boleh kosong"
            ];
        }

        if(Str::lower($jenisDebitur) == Str::lower($jenisDebiturNonPerorangan))
        {
            $data = [
                (object)[
                    "debiturId" => 30025,
                    "nama" => "PT Maju Mundur Terus",
                    "npwp" => "92.657.314.8-666.015",
                    "nikAkta" => "3211054905980005",
                    "tglPenolakan" => "2023-02-15",
                    "unitPemroses" => "PTB BANDUNG",
                    "lastUpdatedDate" => "2023-02-15",
                    "expiredDate" => "2023-03-11",
                    "statusDebitur" => "Debitur Pernah Ditolak",
                    "alasanPenolakanList" => [
                        "0601 - Lokasi Usaha Debitur Jauh",
                        "0602 - Legalitas Jatuh Tempo"
                    ],
                    "namaSentra" => "Cabang Bandung",
                    "appsClientCoreCode1" => "236"        
                ],
                (object)[
                    "debiturId"=> 30026,
                    "nama"=> "PT Maju Terus",
                    "npwp"=> "92.657.314.8-666.015",
                    "nikAkta"=> "3211054905980005",
                    "tglPenolakan"=> "2023-02-15",
                    "unitPemroses"=> "PTB BANDUNG",
                    "lastUpdatedDate"=> "2023-02-15",
                    "expiredDate"=> "2023-03-11",
                    "statusDebitur"=> "Debitur Pernah Ditolak",
                    "alasanPenolakanList"=> [
                        "0601 - Lokasi Usaha Debitur Jauh",
                        "0602 - Legalitas Jatuh Tempo"
                    ],
                    "namaSentra"=> "Cabang Bandung",
                    "appsClientCoreCode1"=> "236"
            
                ]
            ];
        } elseif (Str::lower($jenisDebitur) == Str::lower($jenisDebiturPerorangan)) {
            $data = [
                (object)[
                    "debiturId" => 30025,
                    "nama" => "Shanti H",
                    "npwp" => "92.657.314.8-666.015",
                    "nikAkta" => "3211054905980005",
                    "tglPenolakan" => "2023-02-15",
                    "unitPemroses" => "PTB BANDUNG",
                    "lastUpdatedDate" => "2023-02-15",
                    "expiredDate" => "2023-03-11",
                    "statusDebitur" => "Debitur Pernah Ditolak",
                    "alasanPenolakanList" => [
                        "0601 - Lokasi Usaha Debitur Jauh",
                        "0602 - Legalitas Jatuh Tempo"
                    ],
                    "namaSentra" => "Cabang Bandung",
                    "appsClientCoreCode1" => "236"        
                ],
                (object)[
                    "debiturId"=> 30026,
                    "nama"=> "Shanti H",
                    "npwp"=> "92.657.314.8-666.015",
                    "nikAkta"=> "3211054905980005",
                    "tglPenolakan"=> "2023-02-15",
                    "unitPemroses"=> "PTB BANDUNG",
                    "lastUpdatedDate"=> "2023-02-15",
                    "expiredDate"=> "2023-03-11",
                    "statusDebitur"=> "Debitur Pernah Ditolak",
                    "alasanPenolakanList"=> [
                        "0601 - Lokasi Usaha Debitur Jauh",
                        "0602 - Legalitas Jatuh Tempo"
                    ],
                    "namaSentra"=> "Cabang Bandung",
                    "appsClientCoreCode1"=> "236"
            
                ]
            ];
        } else {
            $responseCode = 400;
            $data = [
                "error" => "Jenis debitur tidak valid"
            ];
        }

        if (count($data) == 0) {
            $responseCode == 404;
        }

        return response()->json($data, $responseCode);
    }

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "nama" => 'required|string|max:255',
            "npwp" => 'required_if:jenisDebitur,==,non-perorangan|string',
            "maksimumKredit" => 'integer',
            "nominalKredit" => 'required|integer',
            // "jenisDebitur" => [
            //     'required',
            //     Rule::in(['perorangan', 'non-perorngan'])->where(function ($input, $values) {
            //         // Case-insensitive check
            //         return in_array(strtolower($input), array_map('strtolower', $values));
            //     }),
            //     'string'
            //     ,
            // ],
            "nikAkta" => 'required_if:jenisDebitur,==,perorangan|string',
            "tempatLahirPendirian" => 'string',
            "tglLahirPendirian" => 'date_format:Y-m-d',
            "alamat" => 'integer',
            "provId" => 'integer',
            "cityId" => 'integer',
            "badanUsahaId"=> 'required_if:jenisDebitur,==,non-perorangan|integer',
            "bidangUsahaId"=> 'integer|required',
            "currencyId"=> 'integer|required',
            "permohonanFasilitas"=> "string|required",
            "sektorEkonomiId"=> 'required',
            // "jenisPemblokiran"=> [
            //     'required',
            //     Rule::in(['ditolak', 'dibatalkan'])->where(function ($input, $values) {
            //         // Case-insensitive check
            //         return in_array(strtolower($input), array_map('strtolower', $values));
            //     }),
            //     'string'
            //     ,
            // ],
            "tglPermohonanDibatalkan"=> 'required|date_format:Y-m-d',
            "alasanPenolakan"=> 'string|required_if:jenisPemblokiran,==,ditolak',
            "narasiPenolakanDibatalkan"=> 'string',
            "noSuratPenolakan"=> 'string',
            "tglSuratPenolakan"=> 'date_format:Y-m-d',
            "keyPersona"=> 'string|required_if:jenisDebitur,==,non-perorangan',
            "penggolonganId"=> 'integer|required',
            "appsClientId"=> 'integer|required',
            "unitPemroses"=> 'string|required',
            "namaSentra"=> 'string',
            "appsClientCoreCode1"=> 'string',
            // "pengurusList"=> 'array|required_if:jenisDebitur,==,non-perorangan',
            //     "nama"=> 'string|required_if:jenisDebitur,==,non-perorangan',
            //     "jabatanId"=> 'integer|required_if:jenisDebitur,==,non-perorangan',
            //     "npwp"=> 'string|required_if:jenisDebitur,==,non-perorangan',
            //     "nik"=> 'string|required_if:jenisDebitur,==,non-perorangan',
            //     "tempatLahir"=> 'string|required_if:jenisDebitur,==,non-perorangan',
            //     "tanggalLahir"=> 'date_format:Y-md|required_if:jenisDebitur,==,non-perorangan'
        ]);
     
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed', 'errors' => $validator->errors()], 422);     
        }
     
        // Your logic here
     
        return response()->json(['message' => 'Success']);
    }
}
