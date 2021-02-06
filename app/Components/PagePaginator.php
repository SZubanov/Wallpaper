<?php


namespace App\Components;


class PagePaginator extends OffsetPaginator
{
    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'data' => $this->items,
            'page' => $this->getPage(),
            'size' => $this->perPage(),
            'total' => $this->getTotal(),
        ];
    }

    public function getPage()
    {
        return (int)$this->page ?? 1;
    }
}
