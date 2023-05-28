<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKerohanian extends Model
{
    use HasFactory;

    protected $table = 'data_kerohanian';
    protected $guarded = ['id'];

    public function kerohanian()
    {
        return $this->hasMany(Kerohanian::class);
    }
}
