<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Document extends Model implements HasMedia, Sortable
{
    use HasFactory;
    use InteractsWithMedia;
    use SortableTrait;

    protected $fillable = [
        'name',

        'order_column',
        'is_visible',
        'on_consumers',
        'on_home',
    ];

    public function casts(): array
    {
        return [
            'is_visible' => 'boolean',
            'on_home' => 'boolean',
            'on_consumers' => 'boolean',
        ];
    }

    public function establishment(): BelongsTo
    {
        return $this->belongsTo(Establishment::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('documents');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        // Add any media conversions if needed
    }

    public function scopeActive($query)
    {
        return $query->where('is_visible', true);
    }

    public function scopeHome($query)
    {
        return $query->where('on_home', true);
    }
}
