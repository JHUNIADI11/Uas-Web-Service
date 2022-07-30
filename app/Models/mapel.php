<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mapel extends Model
{
    use HasFactory;
    protected $table = 'mapel';
    protected $primaryKey = 'id';
    protected $fillable = ['id','kode_mapel', 'kelas','mata_pelajaran','keterangan','id_guru',"id_siswa"];


    public function guru()
    {
        return $this->belongsTo(guru::class,"id_guru");
    }

    public function siswa()
    {
        return $this->belongsTo(siswa::class, 'id_siswa');
    }
}
