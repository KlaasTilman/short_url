<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Url Model
 */
class Url extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'og_url', 'short_url', 'user_id'
    ];

    // Each URL is linked to exactly one user.
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
