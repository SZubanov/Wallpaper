<?php
declare(strict_types=1);

namespace App\Http\Requests\Wallpapers;

use App\Models\Wallpaper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateWallpaperRequest extends FormRequest
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
            'caption_ru'  => 'nullable|string|max:255',
            'caption_en'  => 'nullable|string|max:255',
            'image'       => 'nullable',
            'video'       => 'nullable',
        ];
    }
}
