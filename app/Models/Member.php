<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'order_column',
        'email',
        'phone',
    ];

    public function establishments(): BelongsToMany
    {
        return $this->belongsToMany(Establishment::class);
    }
}
