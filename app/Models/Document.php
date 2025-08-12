<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Document extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name',

        'order_column',
        'is_visible',
        'on_home',
    ];

    public function casts(): array
    {
        return [
            'is_visible' => 'boolean',
            'on_home' => 'boolean',
        ];
    }
}
