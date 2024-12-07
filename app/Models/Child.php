<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'vision_level', 'last_exam_date'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
