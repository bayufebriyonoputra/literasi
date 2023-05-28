<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewLiterasi extends Model
{
    use HasFactory;

    protected $table = 'review_literasi';
    protected $guarded = ['id'];

    public function walas()
    {
        return $this->belongsTo(Guru::class, 'wali_kelas_id');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
