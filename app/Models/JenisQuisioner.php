<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisQuisioner extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'nama_jenis',
        'id_quisioner'
    ];

    public function quisioner() {
        return $this->belongsTo(Quisioner::class,'id_quisioner');
    }

    public function listPertanyaan() {
        return $this->hasMany(ListPertanyaan::class,'id_jenis_quisioner');
    }
}
