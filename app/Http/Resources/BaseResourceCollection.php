<?php


namespace App\Http\Resources;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BaseResourceCollection extends ResourceCollection
{
    public function __construct($resource, $collects = null)
    {
        if ($collects) {
            $this->collects = $collects;
        }
        parent::__construct($resource);
    }
    public function toArray($request)
    {
        return [
            'list' => $this->collection
        ];
    }

    public function toResponse($request)
    {
        $data = $this->resolve($request);
        if ($data instanceof Collection) {
            $data = $data->all();
        }

        $paginated = $this->resource->toArray();

        return array_merge(
            $data,
            [
                'total' => $paginated['total'] ?? null,
                'page'  => $paginated['page'] ?? null,
                'size'  => $paginated['size'] ?? null,
            ],
            $this->with($request),
            $this->additional
        );
    }
}
