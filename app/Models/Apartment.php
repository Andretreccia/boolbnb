<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Apartment extends Model
{
    protected $table = 'apartments';
    protected $fillable = ['user_id', 'address', 'slug', 'title', 'image', 'description', 'n_rooms', 'n_bathroom', 'n_bed', 'square_meters', 'visibility', 'latitude', 'longitude'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }
}