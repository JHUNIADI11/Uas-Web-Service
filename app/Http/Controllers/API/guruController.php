<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class guruController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index','show']]);
    }

     // tampil
   public function index()
   {
       $datas = guru::all();
       return response()->json([
           'pesan' => 'Data Berhasil Ditemukan',
           'data' => $datas
       ], 200);
   }
   // tampil berdasarkan id
   public function show($id)
   {
       $data = guru::find($id);
       if (empty($data)) {
           return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
       }
       return response()->json(['pesan' => 'Data Berhasil Ditemukan', 'data' => $data], 200);
   }
   // create
   public function store(Request $request)
   {
       $validasi = Validator::make($request->all(), [
        'id'=>'required|numeric|unique:guru',
        'nip' => 'required',
        'nama_guru' => 'required',
        'alamat' => 'required',
        'jenis_kelamin' => 'required',
        'no_tlp' => 'required',

       ]);
       if ($validasi->fails()) {
           return response()->json(['pesan' => 'data gagal ditambahkan', 'data' => $validasi->errors()->all()], 404);
       }
       $data = guru::create($request->all());
       return response()->json(['pesan' => 'data berhasil ditambahkan', 'data' => $data], 200);
   }
   // update
   public function update(Request $request, $id)
   {
       $guruku = guru::where('id', $id)->get()->first();
       if (empty($guruku)) {
           return response()->json(['pesan' => 'data tidak ditemukan', 'data' => ''], 404);
       } else {
           $validasi = Validator::make($request->all(), [
            'nip' => 'required',
            'nama_guru' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'no_tlp' => 'required',
           ]);
           if ($validasi->fails()) {
               return response()->json(['pesan' => 'Data Gagal diUpdate', 'data' => $validasi->errors()->all()], 404);
           }
           $guruku->update($request->all());
           return response()->json(['pesan' => 'Data Berhasil disimpan', 'data' => $guruku], 200);
       }
   }
   // Hapus
   public function destroy($id)
   {
       $guruku = guru::find($id);
       if (empty($guruku)) {
           return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
       }
       $guruku->delete();
       return response()->json(['pesan' => 'Data Berhasil dihapus', 'data' => $guruku]);
   }
}
