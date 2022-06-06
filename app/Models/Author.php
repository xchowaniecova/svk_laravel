<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'reg_id',
        'title1_id',
        'title1',
        'name',
        'surname',
        'title2_id',
        'title2',
        'presentation',
        'order'
    ];

    // public function registration() {
    //     return $this->belongsTo(Registration::class, 'reg_id','id');
    // }
}
