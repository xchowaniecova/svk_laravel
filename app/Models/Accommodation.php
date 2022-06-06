<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use HasFactory;
    protected $fillable = [
        'conf_id',
        'user_id',
        'accommodation1',
        'accommodation2',
        'position'
    ];
}
