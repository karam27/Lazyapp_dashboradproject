<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Activity extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'activity_name',
        'duration',
        'date',
    ];
    protected $hidden = ['created_at', 'updated_at'];
    public function child()
    {
        return $this->belongsTo(Child::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
