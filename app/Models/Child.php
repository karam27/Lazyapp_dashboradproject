<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Child extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'vision_level', 'last_exam_date'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function caregiver()
    {
        return $this->belongsTo(caregiver::class, 'parent_id');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
    
}
