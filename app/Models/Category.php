<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'emoji',
        'is_active',
        'name_ru',
        'name_en',
        'rating',
        'media_id',
        'sort'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function wallpapers()
    {
        return $this->hasMany(Wallpaper::class);
    }

}
