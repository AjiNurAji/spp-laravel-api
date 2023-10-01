<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PayController extends Controller
{
    public function create(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            $validate = Validator::make($request->all(), [
                'id_petugas' => 'required',
                'nisn' => 'required',
                'bulan_dibayar' => 'required',
                'tahun_dibayar' => 'required',
                'id_spp' => 'required',
                'jumlah_bayar' => 'required'
            ]);

            if ($validate->fails()) {
                return response()->json($validate->errors());
            }


            $check = Pembayaran::where('nisn', $request->nisn)->where('id_spp', $request->id_spp)->first();

            if (!$check) {
                $store = Pembayaran::create([
                    'id_petugas' => $request->id_petugas,
                    'nisn' => $request->nisn,
                    'tgl_bayar' => $request->tgl_bayar,
                    'bulan_dibayar' => $request->bulan_dibayar,
                    'tahun_dibayar' => $request->tahun_dibayar,
                    'id_spp' => $request->id_spp,
                    'jumlah_bayar' => $request->jumlah_bayar
                ]);
    
                if ($store) {
                    return response()->json([
                        'message' => 'Berhasil melalukan pembayaran!',
                        'data' => $store
                    ]);
                } else {
                    return response()->json([
                        'message' => 'Gagal melakukan pembayaran silahkan coba lagi!'
                    ], 421);
                }
            } else {
                return response()->json([
                    'message' => 'Anda sudah membayar spp'
                ]);
            }
        } else {
            return response()->json([
                'message' => 'Tidak memiliki akses!'
            ], 422);
        }
        
    }

    public function showAll()
    {
        return response()->json(Pembayaran::all());
    }

    public function showBySiswa(string $nisn) {
        $history = Pembayaran::where('nisn', $nisn)->get();

        if ($history !== null) {
            return response()->json($history);
        } else {
            return response()->json([
                'Anda belum pernah melakukan transaksi'
            ], 422);
        }
    }


    public function generate(string $nisn, string $id_pembayaran, string $id_spp) {
        if(Auth::user()->level === 'admin') {
            $data = Pembayaran::where('nisn', $nisn)->where('id_pembayaran', $id_pembayaran)->where('id_spp', $id_spp)->first();
            // return $data;
            foreach ($data as $datas) {
                return response()->json([
                    'dari' => $data->siswa->nama,
                    'nis' => $data->siswa->nis,
                    'tanggal' => 
                ]);
            }
        } else {
            return response()->json([
                'message' => 'Tidak memiliki akses!'
            ], 422);
        }
    }
}
