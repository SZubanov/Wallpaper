<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SearchWallpaperRequest;
use App\Http\Requests\Api\WallpaperRequest;
use App\Http\Resources\BaseResourceCollection;
use App\Http\Resources\Wallpapers\WallpaperResource;
use App\Models\Wallpaper;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class WallpaperController extends Controller
{
    public function getByCategory(WallpaperRequest $request)
    {
        $models = Wallpaper::when(isset($request->category_id), fn($query) => $query->where('category_id', $request->category_id))
            ->with('media')
            ->pagePaginate();
        return new BaseResourceCollection($models, WallpaperResource::class);
    }

    public function show(Wallpaper $wallpaper)
    {
        return new WallpaperResource($wallpaper->load('media'));
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
