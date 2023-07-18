<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKriteria extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'nama_sub',
        'kriteria_id',
        'bobot'
    ];


    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }

    public function alternatif()
    {
        return $this->hasMany(Alternatif::class);
    }
}
