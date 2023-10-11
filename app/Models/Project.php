<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [

        'release' => 'date',
        'language' => 'array'
    ];

    protected $fillable = [
        'title',
        'description',
        'release',
        'thumb',
        'slug',
        'link',
        'language',

    ];
}
