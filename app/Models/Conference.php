<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'order',
        'conf_date',
        'date_start', 
        'date_end', 
        'reg_start', 
        'reg_end'
    ];

    // public function users_section_start() {
    //     return $this->belongsTo(UserSectionStart::class, 'foreign_key');
    // }

    // public function users_section_final() {
    //     return $this->belongsTo(UserSectionFinal::class, 'foreign_key');
    // }
}
