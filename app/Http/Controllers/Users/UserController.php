<?php

declare(strict_types=1);

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\StoreRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Models\User;
use App\Services\Users\UserService as Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use  Illuminate\View\View;

class UserController extends Controller
{
    protected string $templatePath = 'admin.users.';

    public function __construct(Service $service)
    {
        parent::__construct($service);
    }

    public function create(): View
    {
        return $this->createElement();
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $this->storeElement($request->validated());
        return redirect()->route('users.index');
    }

    public function edit(User $user): View
    {
        return $this->editElement($user);
    }

    public function update(UpdateRequest $request, User $user): RedirectResponse
    {
        return $this->updateElement($request->validated(), $user);
    }

    /**
     * Удаление пользователя
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(User $user): JsonResponse
    {
        $response = [];
        if ($user->id === auth()->id()) {
            $response['error'] = __('users.delete.error');
        } else {
            $user->delete();
            $response['success'] = 'OK';
        }

        return response()->json($response);
    }


}
