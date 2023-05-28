<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Guru extends Authenticatable
{
    use HasFactory;

    protected $guarded = ['id'];

    public function tugasLiterasi(){
        return $this->hasMany(TugasLiterasi::class);
    }
}
