<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Activity extends Model
{
    use HasFactory, HasRoles;
    protected $fillable = [
        'child_name',
        'activity_name',
        'duration',
        'date',
    ];
    protected $hidden = ['created_at', 'updated_at'];


}
