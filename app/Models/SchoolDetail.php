<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'address',
        'phone_number',
    ];
    // public function school()
    // {
    //     return $this->belongsTo(School::class);
    // }
}
