<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class avgPerbandinganSubkriteria extends Model
{

    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'subkriteria_id1',
        'subkriteria_id2',
        'avg',
    ];

    public function Subkriteria1()
    {
        return $this->belongsTo(Subkriteria::class, 'subkriteria_id1', 'id');
    }
    public function Subriteria2()
    {
        return $this->belongsTo(Subkriteria::class, 'subkriteria_id2', 'id');
    }
}
