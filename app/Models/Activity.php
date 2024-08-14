<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Activity extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'activities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address',
        'side',
        'user_id',
        'finished'
    ];

    /**
     * Get the user that owns the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include activities of a given user.
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
     * Get all of the activity's descriptions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function descriptions(): MorphMany
    {
        return $this->morphMany(Description::class, 'describable');
    }

    public function ratings()
    {
        return $this->morphMany(Rate::class, 'rateable');
    }

    protected static function boot()
    {
        parent::boot();

        // Delete descriptions when a form is deleted
        static::deleting(function ($form) {
            $form->descriptions()->delete();
        });

        static::creating(function ($form) {
            // $form->month = now()->month;
            // $form->year = now()->year;
            // if (session()->has('selected_month')) {
            //     $form->month = session('selected_month');
            // }
            $form->finished = 0;
        });
    }
}
