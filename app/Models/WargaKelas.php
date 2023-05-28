<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WargaKelas extends Model
{
    use HasFactory;
    protected $table = 'warga_kelas';
    protected $guarded = ['id'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function waliKelas()
    {
        return $this->belongsTo(WaliKelas::class);
    }
}
