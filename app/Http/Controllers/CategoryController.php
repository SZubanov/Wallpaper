<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Categories\StoreCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService as Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    protected string $templatePath = 'admin.categories.';

    public function __construct(Service $service)
    {
        parent::__construct($service);
    }

    public function create(): View
    {
        return $this->createElement();
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $this->storeElement($request->validated());
        return redirect()->route('categories.index');
    }

    public function edit(Category $category): View
    {
        return $this->editElement($category);
    }

    public function update(StoreCategoryRequest $request, Category $category): RedirectResponse
    {
        return $this->updateElement($request->validated(), $category);
    }

    public function destroy(Category $category): JsonResponse
    {
        $category->delete();
        $response['success'] = 'OK';
        return response()->json($response);
    }
}
