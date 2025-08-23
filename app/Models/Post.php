<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

/** @mixin Builder */
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'category_id',
        'user_id',
        'published_at'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function readTime(int $wordsPerMinute = 100): int
    {
        $wordsCount = str_word_count(strip_tags($this->content));
        $minutes = (int)ceil($wordsCount / $wordsPerMinute);

        return max(1, $minutes);
    }

    public function imageUrl(): string
    {
        return Storage::url($this->image);
    }
}
