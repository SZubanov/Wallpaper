<?php

declare(strict_types=1);

namespace App\Services;


use App\Services\Traits\Datatable;

class Service
{
    use Datatable;

    public function getDataForIndex(): array
    {
        return [];
    }

    public function getDataForCreate(): array
    {
        return [];
    }

}
