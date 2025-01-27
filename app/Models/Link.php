<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Link extends Model
{
    use HasFactory;
    protected $fillable = ['original_url', 'shortened_url', 'title', ' click', 'users_id'];
    // Pada model Link
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
