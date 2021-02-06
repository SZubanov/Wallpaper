<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{

    public function toResponse($request)
    {
        return $this->resolve($request);
    }
}
