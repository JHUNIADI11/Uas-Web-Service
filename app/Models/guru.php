<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class guru extends Model
{
    protected $table = 'guru';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nip','nama_guru','alamat','jenis_kelamin','no_tlp'];

    // relasi dari table mapel ke guru
    public function mapel(){
        return $this->hasMany(mapel::class);
    }
}
