<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSectionFinal extends Model
{
    use HasFactory;
    protected $fillable = [
        'conf_id',
        'section_final_id',
        'user_id',
    ];
}
