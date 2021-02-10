<?php

namespace App\Http\Requests\Wallpapers;

use App\Models\Wallpaper;
use App\Rules\MaxUploadedFileSize;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ManyStoreWallpaperRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'device'      => ['required', Rule::in(array_flip(Wallpaper::$devices))],
            'image.*'       => 'required',
            'image'       => [ new MaxUploadedFileSize()],
        ];
    }
}
