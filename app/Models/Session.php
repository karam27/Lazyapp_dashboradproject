<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Session extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'child_id',
        'doctor_id',
        'session_date',
        'vision_level',
        'description',
    ];

    public function Child()
    {
        return $this->belongsTo(Child::class);
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
