<?php

namespace App\Http\Resources\Wallpapers;

use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Media $this */
        return [
            'size'      => $this->size,
            'fullPath'  => $this->getUrl(),
            'url'       => $this->getFullUrl(),
        ];
    }
}
