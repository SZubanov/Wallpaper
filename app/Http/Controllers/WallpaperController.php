<?php

namespace App\Http\Controllers;

use App\Http\Requests\Wallpapers\ManyStoreWallpaperRequest;
use App\Http\Requests\Wallpapers\StoreWallpaperRequest;
use App\Http\Requests\Wallpapers\UpdateWallpaperRequest;
use App\Models\Wallpaper;
use App\Services\WallpaperService as Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WallpaperController extends Controller
{
    protected string $templatePath = 'admin.wallpapers.';

    public function __construct(Service $service)
    {
        parent::__construct($service);
    }

    public function create(): View
    {
        return $this->createElement();
    }

    public function store(StoreWallpaperRequest $request): RedirectResponse
    {
        $this->storeElement($request->validated());
        return redirect()->route('wallpapers.index');
    }

    public function edit(Wallpaper $wallpaper): View
    {
        return $this->editElement($wallpaper);
    }

    public function createMany()
    {
        return $this->getView('create-many', $this->service->getDataForCreateMany());
    }

    public function storeMany(ManyStoreWallpaperRequest $request)
    {
        $this->service->storeMany($request->all());
        return redirect()->route('wallpapers.index');
    }


    public function update(UpdateWallpaperRequest $request, Wallpaper $wallpaper): RedirectResponse
    {
        return $this->updateElement($request->validated(), $wallpaper);
    }

    public function destroy(Wallpaper $wallpaper): JsonResponse
    {
        $wallpaper->delete();
        $response['success'] = 'OK';
        return response()->json($response);
    }
}
