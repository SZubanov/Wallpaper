<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Wallpaper extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public const PHONE = 0;
    public const TABLET = 1;

    public static array $devices = [
        self::PHONE  => 'phone',
        self::TABLET => 'tablet',
    ];

    public const ORDER_DOWNLOADS = 'downloads';
    public const ORDER_RANDOM = 'random';
    public const ORDER_LATEST = 'latest';

    private const PREVIEW_QUALITY = 50;
    private const PREVIEW_WIDTH = 7;
    private const PREVIEW_HEIGHT = 10;

    public static array $order = [
        self::ORDER_DOWNLOADS,
        self::ORDER_RANDOM,
        self::ORDER_LATEST,
    ];

    protected $fillable = [
        'category_id',
        'device',
        'downloads',
        'caption_ru',
        'caption_en',
        'preview_base64'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('video');
        $this->addMediaCollection('preview');
        $this->addMediaConversion('preview')
            ->quality(self::PREVIEW_QUALITY)
            ->width(self::PREVIEW_WIDTH)
            ->height(self::PREVIEW_HEIGHT);
    }

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
