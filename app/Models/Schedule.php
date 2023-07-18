<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{

    use HasFactory;
    protected $fillable = [
        'school_id',
        'date',
        'pic_1',
        'pic_2',
        'pic_1_status',
        'pic_2_status',
        'surat_dinas',
        'description',
        'status',
        'created_at',
        'updated_at',
    ];
    public function pic1()
    {
        return $this->belongsTo(User::class, 'pic_1', 'id');
    }

    // Define the relationship with User model for pic_2
    public function pic2()
    {
        return $this->belongsTo(User::class, 'pic_2', 'id');
    }

    // Define the relationship with SchoolDetail model
    public function school()
    {
        return $this->belongsTo(SchoolDetail::class, 'school_id', 'id');
    }
}
