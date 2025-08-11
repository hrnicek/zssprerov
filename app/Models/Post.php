<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'perex',
        'content',
        'published_at',
    ];

    protected $dates = [
        'published_at',
    ];

    public function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }
}
