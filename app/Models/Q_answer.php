<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Q_answer extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'responden',
        'user',
        'quisioner',
        'answer',
    ];
}
