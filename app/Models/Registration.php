<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'conf_id',
        'user_id',
        'name_contribution',
        'phd',
        'section_start_id',
        'abstract_original_file',
        'abstract_storage_file',
        'iban',
        'swift',
        'agree_bank_account',
        'agree_gdpr',
        'agree_citation',
        'agree_video',
        'program_order'
    ];

    // public function authors() {
    //     return $this->hasMany(Author::class, 'reg_id', 'id');
    // }
}
