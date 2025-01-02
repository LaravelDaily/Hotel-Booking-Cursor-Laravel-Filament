<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class RoomType extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'description',
        'price_per_night',
        'capacity',
        'size'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('photo')
            ->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumbnail')
            ->width(600)
            ->height(400)
            ->sharpen(10)
            ->nonQueued();
    }

    public function getThumbnailUrl(): string
    {
        return $this->getFirstMediaUrl('photo', 'thumbnail') ?: 
            asset('images/room-placeholder.jpg');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class);
    }
} 