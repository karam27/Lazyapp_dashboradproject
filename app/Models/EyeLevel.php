<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class EyeLevel extends Model
{
    use HasFactory, HasRoles;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
