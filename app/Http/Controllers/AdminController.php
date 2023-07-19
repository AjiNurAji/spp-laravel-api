<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Spp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // CURD data siswa
    public function create_siswa(Request $request)
    {
        $user = Auth::user();
        
        if ($user->level === 'admin') {
            $validate = Validator::make($request->all(), [
                'nisn' => 'max:10|required|unique:siswa,nisn',
                'nis' => 'max:8|required|unique:siswa,nis',
                'nama' => 'string|required',
                'id_kelas' => 'required',
                'alamat' => 'required',
                'no_telp' => 'string|required',
                'id_spp' => 'required'
            ]);
    
            if (!Siswa::where('nisn', $request->nisn)->first() && !Siswa::where('nis', $request->nis)->first()) {
                if ($validate->fails()) {
                    return response()->json($validate->errors());
                }

                $store = Siswa::create([
                    'nisn' => $request->nisn,
                    'nis' => $request->nis,
                    'nama' => $request->nama,
                    'id_kelas' => $request->id_kelas,
                    'alamat' => $request->alamat,
                    'no_telp' => $request->no_telp,
                    'id_spp' => $request->id_spp
                ]);
    
                if ($store) {
                    return response()->json([
                        'message' => 'Berhasil menambahkan siswa',
                        'data' => $request->all()
                    ], 200);
                } else {
                    return response()->json([
                        'message' => 'Gagal menambahkan siswa, silahkan coba lagi!'
                    ], 421);
                }
            } else {
                return response()->json([
                    'message' => 'Siswa sudah ditambahkan silahkan coba yang lain!'
                ]);
            }
        } else {
            return response()->json([
                'message' => 'Anda bukan admin!'
            ], 422);
        }
    }

    public function read_siswa()
    {
        $user = Auth::user();
        $data = Siswa::all();
        if ($user->level === 'admin') {
            return response()->json($data, 200);
        } else {
            return response()->json([
                'message' => 'Anda bukan admin!'
            ], 422);
        }
    }

    public function edit_siswa(string $nisn, Request $request)
    {
        $user = Auth::user();

        if ($user->level === 'admin') {
            $data = Siswa::find($nisn);
        
            $validate = Validator::make($request->all(), [
                'nisn' => 'max:10|required',
                'nis' => 'max:8|required',
                'nama' => 'string|required',
                'id_kelas' => 'required',
                'alamat' => 'required',
                'no_telp' => 'string|required',
                'id_spp' => 'required'
            ]);

            if($validate->fails()) {
                return response()->json($validate->errors());
            }

            $update = $data->update([
                'nisn' => $request->nisn,
                'nis' => $request->nis,
                'nama' => $request->nama,
                'id_kelas' => $request->id_kelas,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'id_spp' => $request->id_spp
            ]);

            if ($update) {
                return response()->json([
                    'message' => 'Berhasil mengubah data siswa',
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Gagal mengubah data siswa, silahkan coba lagi!'
                ], 421);
            }
        } else {
            return response()->json([
                'message' => 'Anda bukan admin!'
            ], 422);
        }
    }

    // CRUD data petugas
    public function create_petugas(Request $request)
    {
        $user = Auth::user();
        
        if ($user->level === 'admin') {
            $validate = Validator::make($request->all(), [
                'username' => 'string|required',
                'nama_petugas' => 'string|required',
                'password' => 'string|max:32|required',
                'level' => 'required'
            ]);
    
            if (!User::where('username', $request->username)->first()) {
                if ($validate->fails()) {
                    return response()->json($validate->errors());
                }

                $store = User::create([
                    'username' => $request->username,
                    'nama_petugas' => $request->nama_petugas,
                    'password' => $request->password,
                    'level' => $request->level
                ]);
    
                if ($store) {
                    return response()->json([
                        'message' => 'Berhasil menambahkan petugas',
                        'data' => $request->all()
                    ], 200);
                } else {
                    return response()->json([
                        'message' => 'Gagal menambahkan petugas, silahkan coba lagi!'
                    ], 421);
                }
            } else {
                return response()->json([
                    'message' => 'Username sudah digunakan silahkan coba yang lain!'
                ]);
            }
        } else {
            return response()->json([
                'message' => 'Anda bukan admin!'
            ], 422);
        }
    }

    public function read_petugas()
    {
        $user = Auth::user();
        $data = User::where('level', 'petugas')->get();
        if ($user->level === 'admin') {
            return response()->json($data, 200);
        } else {
            return response()->json([
                'message' => 'Anda bukan admin!'
            ], 422);
        }
    }
    
    // CRUD data kelas
    public function create_kelas(Request $request)
    {
        $user = Auth::user();
        
        if ($user->level === 'admin') {
            $validate = Validator::make($request->all(), [
                'nama_kelas' => 'string|required',
                'kompetensi_keahlian' => 'string|required'
            ]);
    
            if (!Kelas::where('nama_kelas', $request->nama_kelas)->first()) {
                if ($validate->fails()) {
                    return response()->json($validate->errors());
                }

                $store = Kelas::create([
                    'nama_kelas' => $request->nama_kelas,
                    'kompetensi_keahlian' => $request->kompetensi_keahlian
                ]);
    
                if ($store) {
                    return response()->json([
                        'message' => 'Berhasil menambahkan kelas',
                        'data' => $request->all()
                    ], 200);
                } else {
                    return response()->json([
                        'message' => 'Gagal menambahkan kelas, silahkan coba lagi!'
                    ], 421);
                }
            } else {
                return response()->json([
                    'message' => 'Kelas sudah ada silahkan tambakan yang lain!'
                ]);
            }
        } else {
            return response()->json([
                'message' => 'Anda bukan admin!'
            ], 422);
        }
    }

    public function read_kelas()
    {
        $user = Auth::user();
        $data = Kelas::all();
        if ($user->level === 'admin') {
            return response()->json($data, 200);
        } else {
            return response()->json([
                'message' => 'Anda bukan admin!'
            ], 422);
        }
    }

    // CRUD data spp
    public function create_spp(Request $request)
    {
        $user = Auth::user();
        
        if ($user->level === 'admin') {
            $validate = Validator::make($request->all(), [
                'nominal' => 'integer|required',
                'tahun' => 'integer|required'
            ]);

            if ($validate->fails()) {
                return response()->json($validate->errors());
            }

            $store = Spp::create([
                'nominal' => $request->nominal,
                'tahun' => $request->tahun
            ]);

            if ($store) {
                return response()->json([
                    'message' => 'Berhasil menambahkan spp',
                    'data' => $request->all()
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Gagal menambahkan spp, silahkan coba lagi!'
                ], 421);
            }
        } else {
            return response()->json([
                'message' => 'Anda bukan admin!'
            ], 422);
        }
    }

    public function read_spp()
    {
        $user = Auth::user();
        $data = Spp::all();
        if ($user->level === 'admin') {
            return response()->json($data, 200);
        } else {
            return response()->json([
                'message' => 'Anda bukan admin!'
            ], 422);
        }
    }
}
