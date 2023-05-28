<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanPerpustakaan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan_perpus';
    protected $guarded = ['id'];
}
