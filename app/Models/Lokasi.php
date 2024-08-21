<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Lokasi extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $table = 'lokasi';

    // protected $attributes = [
    // ];

    protected $fillable = [
        'node_id',
        'user_id',
        'nama',
        'no_hp',
        'alamat_pemilik',
    ];

    public function node()
    {
        return $this->hasOne('App\Models\node', 'id', 'node_id');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(168)
            ->height(32)
            ->sharpen(10);
    }

    public function nama(): Attribute
    {
        return Attribute::make(
            fn ($value) => $value,
            fn ($value) => $value,
        );
    }
}
