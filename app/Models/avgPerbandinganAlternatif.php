<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class avgPerbandinganAlternatif extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'alternatif_id1',
        'alternatif_id2',
        'avg',
    ];

    public function alternatif1()
    {
        return $this->belongsTo(Alternatif::class, 'alternatif_id1', 'id');
    }
    public function Subriteria2()
    {
        return $this->belongsTo(Alternatif::class, 'alternatif_id2', 'id');
    }
}
