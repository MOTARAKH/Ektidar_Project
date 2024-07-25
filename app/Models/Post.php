<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;


class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [
        'slug', 
        'title', 
        'image_path', 
        'user_id'
    ];

    /* get the post owner from the post itself */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /* To get all posts by a specific user */
    public function scopeOfUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    /* Get all of the post's descriptions */
    public function descriptions(): MorphMany
    {
        return $this->morphMany(Description::class, 'describable');
    }

}
