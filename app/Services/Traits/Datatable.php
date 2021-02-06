<?php

declare(strict_types=1);

namespace App\Services\Traits;


trait Datatable
{
    /** языковые переводы */
    protected string $translate = '';

    /**
     * Добавить заголовки колонок из языковых файлов
     *
     * @param array $columns
     * @return array
     */
    protected function addCaptionForColumns(array $columns): array
    {
        $trans = $this->translate . '.table.';

        foreach ($columns as $key => $column) {
            if (isset($column['data'])) {
                $columns[$key]['caption'] = __($trans . $column['data']);
            }
        }

        return $columns;
    }

    public function getColumns(): array
    {
        return [];
    }

    /**
     *
     * @return false|string
     * @throws \JsonException
     */
    public function getJsonColumns()
    {
        return json_encode($this->getColumns(), JSON_THROW_ON_ERROR);
    }

}
