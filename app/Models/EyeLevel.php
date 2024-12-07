<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class EyeLevel extends Model
{
    use HasFactory, HasRoles;

    protected $fillable = ['user_id', 'level', 'exam_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
