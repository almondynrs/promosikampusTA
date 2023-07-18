<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'nama_alternatif',
        'sub_kriteria_id',
        'bobot'
    ];

    public function subKriteria(){
        return $this->belongsTo(SubKriteria::class,'sub_kriteria_id');
    }

}
