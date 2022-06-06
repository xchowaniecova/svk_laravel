<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsPage extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'title_nav',
        'slug',
        'content1',
        'content2',
        'status',
        'order',
        'editable'
    ];
}