<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class avgPerbandinganKriteria extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'kriteria_id1',
        'kriteria_id2',
        'avg',
    ];

    public function Kriteria1() {
        return $this->belongsTo(Kriteria::class,'kriteria_id1', 'id');
    }
    public function Kriteria2() {
        return $this->belongsTo(Kriteria::class,'kriteria_id2', 'id');
    }
}
