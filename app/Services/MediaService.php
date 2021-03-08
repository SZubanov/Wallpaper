<?php
declare(strict_types=1);

namespace App\Services;


use App\Models\Wallpaper;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaService
{
    public static function setBase64Preview(Wallpaper $wallpaper): Wallpaper
    {
        $media = self::createPreview($wallpaper);
        $previewPath = $media->getPath('preview');
        $wallpaper->preview_base64 = base64_encode(file_get_contents($previewPath));
        $wallpaper->save();
        $wallpaper->refresh()->clearMediaCollection('preview');
        return $wallpaper;
    }

    private static function createPreview(Wallpaper $wallpaper): Media
    {
        return $wallpaper
            ->addMedia($wallpaper->getFirstMedia()->getPath())
            ->preservingOriginal()
            ->toMediaCollection('preview');
    }
}
