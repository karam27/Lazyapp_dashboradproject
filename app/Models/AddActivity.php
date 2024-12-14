<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'activities_id',
        'vision_level',
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activities_id');
    }
}
