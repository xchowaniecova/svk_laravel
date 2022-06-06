<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section_start extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'name_en', 'conf_id', 'final_created'];
}
