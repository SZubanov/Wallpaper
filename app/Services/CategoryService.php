<?php


namespace App\Services;


use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

class CategoryService extends ModelService
{
    protected string $translate = 'categories';

    public function __construct()
    {
        parent::__construct(app(Category::class));
    }

    public function getDataForIndex(): array
    {
        return [
            'columns'     => $this->getColumns(),
            'jsonColumns' => $this->getJsonColumns(),
        ];
    }

    public function getDataForCreate(): array
    {
        return array_merge([
            'method'     => 'create',
            'formRoute' => route('categories.store')
        ]);
    }

    public function getDataForEdit(Category $model): array
    {
        return array_merge([
            'method'     => 'update',
            'formMethod' => 'PUT',
            'formRoute'  => route('categories.update', $model),
            'category'   => $model->load('media'),
        ]);
    }

    public function store(array $data): Model
    {
        $category = $this->model->create($data);
        if (isset($data['image'])) {
            $category->addMedia($data['image'])->toMediaCollection();
        }
        return $category;
    }

    public function update(array $data, Model $model): bool
    {
        if (isset($data['image'])) {
            $model->clearMediaCollection();
            $model->addMedia($data['image'])->toMediaCollection();
        }
        return $model->update($data);
    }

    public function getColumns(): array
    {
        $columns = [
            [
                'data' => 'sort',
                'sortable' => false,
            ],
            [
                'data' => 'emoji',
                'searchable' => false,
                'sortable' => false,
            ],
            [
                'data' => 'name_ru',
            ],
            [
                'data' => 'name_en',
            ],
            [
                'data' => 'wallpapers_count',
                'searchable' => false,
                'sortable' => false,
            ],
            [
                'data' => 'rating',
                'sortable' => false,
            ],
            [
                'data' => 'is_active',
                'searchable' => false,
                'sortable' => false,
            ],
            [
                'data'       => 'action',
                'sortable'   => false,
                'searchable' => false,
            ],
        ];

        return $this->addCaptionForColumns($columns);
    }

    public function getObjectsForTable(array $params = []): JsonResponse
    {
        $query = $this->queryForTable($params);
        return $this->makeDatatable($query)
            ->addColumn('action', fn($category) => view('admin.categories.datatable.action', ['category' => $category]))
            ->addColumn('is_active', fn($category) => $category->is_active
                ? '<i class="fas fa-check text-success"></i>'
                : '<i class="fas fa-times text-danger"></i>')
            ->rawColumns(['is_active', 'action'])
            ->make(true);
    }

    protected function queryForTable(array $params = []): Builder
    {
        return $this
            ->getQuery()
            ->select('*')
            ->withCount('wallpapers')
            ->orderBy('sort');
    }
}
