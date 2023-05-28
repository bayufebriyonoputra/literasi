<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UKBI extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'ukbis';

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
