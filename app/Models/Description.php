<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    use HasFactory;
    protected $table = 'descriptions';

    protected $fillable = [
        'description',
        'describable_id',
        'describable_type'
    ];

    /**
     * Get the parent describable model (post, form, etc.).
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function describable()
    {
        return $this->morphTo();
    }

}
