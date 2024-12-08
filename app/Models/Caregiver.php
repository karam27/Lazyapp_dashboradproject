<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Caregiver extends Model
{
    use HasFactory, SoftDeletes;
    public function children()
    {
        return $this->hasMany(Child::class, 'caregiver_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
