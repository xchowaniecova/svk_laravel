<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
    use HasFactory;
    protected $fillable = [
        'section_final_id',
        'member_name',
        'workplace_name',
        'workplace_state',
        'member_order',
        'accommodation_id'
    ];
}
