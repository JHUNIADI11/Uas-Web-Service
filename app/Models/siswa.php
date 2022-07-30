<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nis','nama_siswa','alamat','jurusan'];

    public function siswa(){
        return $this->hasMany(siswa::class);
    }
}
