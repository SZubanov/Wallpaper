<?php

declare(strict_types=1);

namespace App\Services\Users;


use App\Models\User;
use App\Services\ModelService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class UserService extends ModelService
{
    protected string $translate = 'users';

    public function __construct()
    {
        parent::__construct(app(User::class));
    }

    public function getDataForIndex(): array
    {
        return [
            'columns' => $this->getColumns(),
            'jsonColumns' => $this->getJsonColumns(),
        ];
    }

    public function getDataForCreate(): array
    {
        return array_merge([
            'formRoute' => route('users.store')
        ]);
    }

    public function getDataForEdit(User $user): array
    {
        return array_merge([
            'formMethod' => 'PUT',
            'formRoute' => route('users.update', $user),
            'user' => $user,
        ]);
    }

    public function getColumns(): array
    {
        $columns = [
            [
                'data' => 'id',
            ],
            [
                'data' => 'name',
            ],
            [
                'data' => 'email',
            ],
            [
                'data' => 'action',
                'sortable' => false,
                'searchable' => false,
            ],
        ];

        return $this->addCaptionForColumns($columns);
    }

    public function getObjectsForTable(array $params = []): JsonResponse
    {
        $query = $this->queryForTable($params);
        return $this->makeDatatable($query)
            ->addColumn('action', fn($user) => view('admin.users.datatable.action', ['user' => $user]))
            ->rawColumns(['action'])
            ->make(true);
    }

    public function setToken(User $user): User
    {
        $token = Str::random(80);
        $user->forceFill([
            'api_token' =>  hash('sha256', $token),
        ])->save();

        return $user;
    }


}
