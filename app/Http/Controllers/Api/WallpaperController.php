<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Wallpaper\SearchWallpaperRequest;
use App\Http\Requests\Api\Wallpaper\WallpaperRequest;
use App\Http\Requests\Wallpapers\StoreWallpaperRequest;
use App\Http\Resources\BaseResourceCollection;
use App\Http\Resources\Wallpapers\WallpaperResource;
use App\Models\Wallpaper;
use App\Services\WallpaperService as Service;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class WallpaperController extends Controller
{
    public function __construct(Service $service)
    {
        parent::__construct($service);
    }


    public function getByCategory(WallpaperRequest $request): BaseResourceCollection
    {
        $models = Wallpaper::when(isset($request->category_id), fn($query) => $query->where('category_id', $request->category_id))
            ->when(isset($request->orderBy) && $request->orderBy === Wallpaper::ORDER_DOWNLOADS, fn($query) => $query->orderBy('downloads', 'desc'))
            ->when(isset($request->orderBy) && $request->orderBy === Wallpaper::ORDER_RANDOM, fn($query) => $query->inRandomOrder())
            ->when(isset($request->orderBy) && $request->orderBy === Wallpaper::ORDER_LATEST, fn($query) => $query->latest())
            ->with('media')
            ->pagePaginate();

        return new BaseResourceCollection($models, WallpaperResource::class);
    }

    public function show(Wallpaper $wallpaper): WallpaperResource
    {
        return new WallpaperResource($wallpaper->load('media'));
    }

    public function store(StoreWallpaperRequest $request): WallpaperResource
    {
        $wallpaper = $this->service->store($request->validated());
        return new WallpaperResource($wallpaper);
    }

    public function destroy(Wallpaper $wallpaper): JsonResponse
    {
        $wallpaper->delete();
        return response()->json(['success' => true, 'data' => 'ok', 'code' => 200]);
    }

    public function download(Wallpaper $wallpaper): BinaryFileResponse
    {
        $wallpaper->downloads++;
        $wallpaper->save();
        $mediaItem = $wallpaper->getFirstMedia();
        return response()->download($mediaItem->getPath(), $mediaItem->file_name);
    }

    public function search(SearchWallpaperRequest $request): BaseResourceCollection
    {
        $models = Wallpaper::where('caption_ru', 'like', '%' . trim($request->q) . '%')
            ->orWhere('caption_en', 'like', '%' . trim($request->q) . '%')
            ->with('media')
            ->pagePaginate();

        return new BaseResourceCollection($models, WallpaperResource::class);

    }
}
