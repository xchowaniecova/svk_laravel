<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'name_en', 'university_id'];

    public function universities() 
    {
        return $this->belongsTo(University::class,'university_id','id');
    }
}
