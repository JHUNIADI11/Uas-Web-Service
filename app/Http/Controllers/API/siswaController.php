<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class siswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index','show']]);
    }

    // tampil
    public function index()
    {
        $datas = siswa::all();
        return response()->json([
            'pesan' => 'Data Berhasil Ditemukan',
            'data' => $datas
        ], 200);
    }
    // tampil berdasarkan id
    public function show($id)
    {
        $data = siswa::find($id);
        if (empty($data)) {
            return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
        }
        return response()->json(['pesan' => 'Data Berhasil Ditemukan', 'data' => $data], 200);
    }
    // create
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'nis' => 'required',
            'nama_siswa' => 'required',
            'alamat' => 'required',
            'jurusan' => 'required',

        ]);
        if ($validasi->fails()) {
            return response()->json(['pesan' => 'data gagal ditambahkan', 'data' => $validasi->errors()->all()], 404);
        }
        $data = siswa::create($request->all());
        return response()->json(['pesan' => 'data berhasil ditambahkan', 'data' => $data], 200);
    }
    // update
    public function update(Request $request, $id)
    {
        $siswaku = siswa::where('id', $id)->get()->first();
        if (empty($siswaku)) {
            return response()->json(['pesan' => 'data tidak ditemukan', 'data' => ''], 404);
        } else {
            $validasi = Validator::make($request->all(), [
                'nis' => 'required',
                'nama_siswa' => 'required',
                'alamat' => 'required',
                'jurusan' => 'required',

            ]);
            if ($validasi->fails()) {
                return response()->json(['pesan' => 'Data Gagal diUpdate', 'data' => $validasi->errors()->all()], 404);
            }
            $siswaku->update($request->all());
            return response()->json(['pesan' => 'Data Berhasil disimpan', 'data' => $siswaku], 200);
        }
    }
    // Hapus
    public function destroy($id)
    {
        $siswaku = siswa::find($id);
        if (empty($siswaku)) {
            return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
        }
        $siswaku->delete();
        return response()->json(['pesan' => 'Data Berhasil dihapus', 'data' => $siswaku]);
    }

    // tes relasi
    public function indexRelasi()
    {
        $siswa = siswa::with('mapel')->get();
        return response()->json(['pesan' => 'Data Berhasil ditemukan', 'data' => $siswa], 200);
    }
}
