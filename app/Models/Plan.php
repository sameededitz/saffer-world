<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Log;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Stripe\Price;
use Stripe\Stripe;
use Stripe\StripeClient;

class Plan extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'bundle_id',
        'name',
        'slug',
        'description',
        'price',
        'duration',
        'type'
    ];

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
