<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Start_final extends Model
{
    use HasFactory;
    protected $fillable = ['section_start_id', 'section_final_id'];
}
