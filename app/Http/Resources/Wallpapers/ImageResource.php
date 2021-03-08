<?php
declare(strict_types=1);

namespace App\Http\Resources\Wallpapers;

use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ImageResource extends JsonResource
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
        return [
            'size'     => $image->size,
            'fullPath' => $image->getUrl(),
            'url'      => $image->getFullUrl(),
            'preview'  => $this->preview_base64,
        ];
    }
}
