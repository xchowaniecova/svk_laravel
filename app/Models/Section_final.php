<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section_final extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'name_en', 
        'conf_id', 
        'room', 
        'room_online',
        'admin_name', 
        'admin_email', 
        'type'
    ];
}
