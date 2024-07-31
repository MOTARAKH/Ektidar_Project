<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $table = 'rates';

    // Specify which attributes are mass assignable
    protected $fillable = [
        'rating',
        'user_id',
        'rateable_id',
        'rateable_type',
    ];
    
    protected $casts = [
        'rating' => 'integer',
        'user_id' => 'integer',
        'rateable_id' => 'integer',
    ];

    /**
     * Get the parent rateable model (post, form, etc.)
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function rateable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the user who gave the rating.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
