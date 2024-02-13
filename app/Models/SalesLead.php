<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SalesLead extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'message'
    ];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(SalesTag::class);
    }
}
