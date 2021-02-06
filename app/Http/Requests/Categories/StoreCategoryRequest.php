<?php

declare(strict_types=1);

namespace App\Http\Requests\Categories;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'emoji'     => 'nullable|string',
            'name_ru'   => 'required|string|max:255',
            'name_en'   => 'nullable|string|max:255',
            'rating'    => 'nullable|integer',
            'sort'      => 'nullable|integer',
            'is_active' => 'required|boolean',
            'image'     => 'nullable|image',
        ];
    }
}
