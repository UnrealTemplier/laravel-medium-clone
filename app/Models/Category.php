<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/** @mixin Builder */
class Category extends Model
{
    protected $fillable = ['name'];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
