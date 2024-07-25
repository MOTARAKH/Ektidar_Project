<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Form extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'forms';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['side', 'title', 'month', 'year', 'user_id', 'finished'];


    /**
     * Get the owner of the form.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include forms of a given user.
     */
    public function scopeOfUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Get all of the form's descriptions.
     */
    public function descriptions(): MorphMany
    {
        return $this->morphMany(Description::class, 'describable');
    }



    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Delete descriptions when a form is deleted
        static::deleting(function ($form) {
            $form->descriptions()->delete();
        });

        static::creating(function ($form) {
            $form->month = now()->month;
            $form->year = now()->year;
            if (session()->has('selected_month')) {
                $form->month = session('selected_month');
            }
            $form->finished = 0;
        });
    }
}
