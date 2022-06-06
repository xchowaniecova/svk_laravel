<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSectionStart extends Model
{
    use HasFactory;
    protected $fillable = [
        'conf_id',
        'section_start_id',
        'user_id',
    ];
}
