<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'published_at' => 'datetime:Y-m-d',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopePublished($query): Builder
    {
        return $query->where('published_at', '<=', now());
    }

    public function image(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => filter_var($value, FILTER_VALIDATE_URL) ? $value : asset('storage/' . $value),
            set: fn($value): string => filter_var($value, FILTER_VALIDATE_URL) ? $value : $value->store('posts', 'public')
        );
    }
}
