<?php


namespace App\Services;


use App\Models\Category;
use App\Models\Wallpaper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

class WallpaperService extends ModelService
{
    protected string $translate = 'wallpapers';

    public function __construct()
    {
        parent::__construct(app(Wallpaper::class));
    }

    public function getDataForIndex(): array
    {
        return [
            'categories'  => self::getCategories(),
            'columns'     => $this->getColumns(),
            'jsonColumns' => $this->getJsonColumns(),
        ];
    }

    public function getDataForCreate(): array
    {
        return array_merge([
            'categories' => self::getCategories(),
            'devices'    => Wallpaper::$devices,
            'method'     => 'create',
            'formRoute'  => route('wallpapers.store')
        ]);
    }

    public function getDataForEdit(Wallpaper $model): array
    {
        return array_merge([
            'method'     => 'update',
            'formMethod' => 'PUT',
            'formRoute'  => route('wallpapers.update', $model),
            'wallpaper'  => $model->load('media'),
            'categories' => self::getCategories(),
            'devices'    => Wallpaper::$devices,
        ]);
    }

    public function store(array $data): Model
    {
        $wallpaper = $this->model->create($data);
        if (isset($data['image'])) {
            $wallpaper->addMedia($data['image'])->toMediaCollection();
        }
        return $wallpaper;
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
                'data' => 'id',
            ],
            [
                'data' => 'category_id',
                'sortable'   => false,
            ],
            [
                'data' => 'downloads',
            ],
            [
                'data' => 'caption_ru',
            ],
            [
                'data' => 'size',
                'sortable' => false,
            ],
            [
                'data' => 'device',
                'sortable' => false,
            ],
            [
                'data' => 'created_at',
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
            ->addColumn('category_id', fn($model) => $model->category->name_ru ?? '')
            ->addColumn('size', fn($model) => round($model->media->first()->size / 1024, 2) . ' KB' ?? '')
            ->addColumn('device', fn($model) => Wallpaper::$devices[$model->device])
            ->addColumn('created_at', fn($model) => Carbon::parse($model->created_at)->format('d.m.Y'))
            ->addColumn('action', fn($model) => view('admin.wallpapers.datatable.action', ['wallpaper' => $model]))
            ->rawColumns(['action'])
            ->make(true);
    }

    protected function queryForTable(array $params = []): Builder
    {
        return $this
            ->getQuery()
            ->with(['media', 'category'])
            ->filterCategory($params ?? []);
    }

    private static function getCategories()
    {
        return Category::orderBy('sort')->get();
    }
}
