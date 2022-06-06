<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'title1_id',
        'title2_id',
        'role',
        'faculty_id',
        'student_id',
        'faculty',
        'university'
    ];

    // public function first_title() {
    //     return $this->hasMany(FirstTitle::class, 'title1_id','id');
    // }

    // public function second_title() {
    //     return $this->hasMany(SecondTitle::class, 'title2_id','id');
    // }


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
