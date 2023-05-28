<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $guarded = ['id'];

    public function waliKelas()
    {
        return $this->hasOne(WaliKelas::class);
    }

    public function wargaKelas()
    {
        return $this->hasOne(WargaKelas::class);
    }

    public function tugasLiterasi(){
        return $this->hasMany(TugasLiterasi::class);
    }
}
