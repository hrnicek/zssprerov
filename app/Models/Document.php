<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'name',
        'file_path',
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
