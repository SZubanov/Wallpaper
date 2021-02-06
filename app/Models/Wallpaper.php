<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Wallpaper extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public const PHONE = 0;
    public const TABLET = 1;

    public static array $devices = [
        self::PHONE  => 'phone',
        self::TABLET => 'tablet',
    ];

    protected $fillable = [
        'category_id',
        'device',
        'downloads',
        'caption_ru',
        'caption_en'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilterCategory($query, array $params)
    {
        return $query->when(!empty($params) and isset($params['category_id']), function ($query) use ($params) {
            return $query->where('category_id', $params['category_id']);
        });
    }
}
