<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Visit extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'visits';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'side',
        'user_id'
    ];

    /**
     * Get the user that owns the visit.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include visits of a given user.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Get all of the visit's descriptions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function descriptions(): MorphMany
    {
        return $this->morphMany(Description::class, 'describable');
    }
}
