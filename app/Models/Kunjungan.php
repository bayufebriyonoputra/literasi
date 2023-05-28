<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function tempat()
    {
        return $this->belongsTo(Tempat::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
