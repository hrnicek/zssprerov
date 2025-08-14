<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia;
    use Sluggable;

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

    public function scopeActive($query)
    {
        return $query->where('is_visible', true)
            ->where('published_at', '<=', now());
    }

    public function casts(): array
    {
        return [
            'is_visible' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }
}
