<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'name_en', 'shortcut', 'country_id'];

    public function faculties() 
    {
        return $this->hasMany(Faculty::class,'university_id','id');
    }
}

