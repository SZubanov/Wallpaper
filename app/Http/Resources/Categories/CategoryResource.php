<?php

namespace App\Http\Resources\Categories;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $background = $this->getFirstMedia();
        return [
            'id' => $this->id,
            'emoji' => $this->emoji,
            'isActive' => $this->is_active,
            'items' => $this->wallpapers_count,
            'rating' => $this->rating,
            'name' => [
                'en' => $this->name_en,
                'ru' => $this->name_ru,
            ],
            'background' => [
               'fullPath' => $background ? $background->getUrl() : '',
               'url' => $background ? $background->getFullUrl() : '',
            ]
        ];
    }
}
