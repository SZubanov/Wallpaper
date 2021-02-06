<?php

namespace App\Http\Resources\Wallpapers;

use App\Models\Wallpaper;
use Illuminate\Http\Resources\Json\JsonResource;

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
        return [
            'id'        => $this->id,
            'category'  => [
                'id'      => $this->category_id,
                'name_ru' => $this->category->name_ru,
                'name_en' => $this->category->name_en,
            ],
            'date'      => $this->created_at,
            'device'    => Wallpaper::$devices[$this->device],
            'downloads' => $this->downloads ?? 0,
            'size'      => $this->getFirstMedia()->size,
            'fullPath'  => $this->getFirstMedia()->getUrl(),
            'url'       => $this->getFirstMedia()->getFullUrl()
        ];
    }
}
