<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnggahKarya extends Model
{
    use HasFactory;

    protected $table = 'unggah_karya';
    protected $guarded = ['id'];

    public function karya()
    {
        return $this->belongsTo(Karya::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
