<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Child extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'caregivers_id',
        'doctor_id',
        'birth_date',
        'weak_eye',
        'other_details',
        'name',
        'vision_level',
        'last_exam_date',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function caregiver()
    {
        return $this->belongsTo(User::class, 'caregivers_id');
    }


    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

}
