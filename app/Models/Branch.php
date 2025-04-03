<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;


class Branch extends Model
{
    use HasFactory, HasSlug;

    protected $table = 'branches';

    protected $fillable = [
        'name',
        'slug',
        'governorate_id',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function governorate()
    {
        return $this->belongsTo(Governorate::class, 'governorate_id');
    }
}