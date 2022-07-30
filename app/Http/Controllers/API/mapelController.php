<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\mapel;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class mapelController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index','show']]);
    }

    // tampil
   public function index()
   {
       $datas = mapel::all();
       return response()->json([
           'pesan' => 'Data Berhasil Ditemukan',
           'data' => $datas
       ], 200);
   }
   // tampil berdasarkan id
   public function show($id)
   {
       $data = mapel::find($id);
       if (empty($data)) {
           return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
       }
       return response()->json(['pesan' => 'Data Berhasil Ditemukan', 'data' => $data], 200);
   }
   // create
   public function store(Request $request)
   {
       $validasi = Validator::make($request->all(), [
        'kode_mapel' => 'required',
        'kelas' => 'required',
        'mata_pelajaran' => 'required',
        'keterangan' => 'required',

       ]);
       if ($validasi->fails()) {
           return response()->json(['pesan' => 'data gagal ditambahkan', 'data' => $validasi->errors()->all()], 404);
       }
       $data = mapel::create($request->all());
       return response()->json(['pesan' => 'data berhasil ditambahkan', 'data' => $data], 200);
   }
   // update
   public function update(Request $request, $id)
   {
       $mapelku = mapel::where('id',$id)->get()->first();
       if (empty($mapelku)) {
           return response()->json(['pesan' => 'data tidak ditemukan', 'data' => ''], 404);
       } else {
           $validasi = Validator::make($request->all(), [
            'kode_mapel' => 'required',
            'kelas' => 'required',
            'mata_pelajaran' => 'required',
            'keterangan' => 'required',

           ]);
           if ($validasi->fails()) {
               return response()->json(['pesan' => 'Data Gagal diUpdate', 'data' => $validasi->errors()->all()], 404);
           }
           $mapelku->update($request->all());
           return response()->json(['pesan' => 'Data Berhasil disimpan', 'data' => $mapelku], 200);
       }
   }
   // Hapus
   public function destroy($id)
   {
       $mapelku = mapel::find($id);
       if (empty($mapelku)) {
           return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
       }
       $mapelku->delete();
       return response()->json(['pesan' => 'Data Berhasil dihapus', 'data' => $mapelku]);
   }

   // tes relasi
   public function indexRelasi()
   {
       $mapel = mapel::with('guru','siswa')->get();
       return response()->json(['pesan' => 'Data Berhasil ditemukan', 'data' => $mapel], 200);
   }

      // tes relasi
    //   public function indexRelasisiswa()
    //   {
    //       $mapel = mapel::with('siswa')->get();
    //       return response()->json(['pesan' => 'Data Berhasil ditemukan', 'data' => $mapel], 200);
    //   }
}
