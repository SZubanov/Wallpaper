<?php

declare(strict_types=1);

namespace App\Services;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;

class ModelService extends Service
{
    /** Основная модель сервиса */
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Вернуть пустой Builder запрос к модели сервайса
     *
     * @return Builder
     */
    public function getQuery(): Builder
    {
        return $this->model->query();
    }

    /**
     * Вернуть коллекцию со всеми элементами модели
     * @return Collection
     */
    public function getAllCollect(): Collection
    {
        return $this->getQuery()->get();
    }

    /**
     * Вернуть коллекцию по определенным параметрам
     *
     * @param array $params
     * @return Builder[]|Collection
     */
    protected function getAllCollectByParams(array $params)
    {
        return $this->getQuery()->where($params)->get();
    }


    /**
     * Добавляет запись в БД
     *
     * @param array $data
     * @return Model
     */
    public function store(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(array $data, Model $model): bool
    {
        return $model->update($data);
    }

    /**
     * @param array $params - массив с фильтрами
     * @return Builder
     */
    protected function queryForTable(array $params = []): Builder
    {
        return $this
            ->getQuery()
            ->select('*');
    }

    /**
     * @param Builder $builder - Запрос для вывода
     * @return mixed
     * @throws \Exception
     */
    protected function makeDatatable(Builder $builder)
    {
        return Datatables::of($builder);
    }

    /**
     * Результат для вывода datatable
     *
     * @param array $params
     * @return mixed
     * @throws \Exception
     */
    public function getObjectsForTable(array $params = [])
    {
        $query = $this->queryForTable($params);
        return $this->makeDatatable($query)->make(true);
    }

}
