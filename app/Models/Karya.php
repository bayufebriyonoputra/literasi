<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karya extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function unggahanKarya()
    {
        return $this->hasMany(UnggahKarya::class);
    }
}
