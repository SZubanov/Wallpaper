<?php

namespace App\Http\Resources\Wallpapers;

use App\Models\Wallpaper;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class WallpaperResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Media $image */
        $image = $this->getFirstMedia();
        /** @var Media $video */
        $video = $this->getFirstMedia('video');
        return [
            'id'        => $this->id,
            'category'  => [
                'id' => $this->category_id,
                'ru' => $this->category->name_ru,
                'en' => $this->category->name_en,
            ],
            'caption'   => [
                'ru' => $this->caption_ru,
                'en' => $this->caption_en,
            ],
            'date'      => $this->created_at,
            'device'    => Wallpaper::$devices[$this->device],
            'downloads' => $this->downloads ?? 0,
            'image'     => new MediaResource($image),
            'video'     => new MediaResource($video),
        ];
    }
}
