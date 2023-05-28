<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kerohanian extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function dataKerohanian()
    {
        return $this->belongsTo(DataKerohanian::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
