<?php
declare(strict_types=1);

namespace App\Http\Requests\Wallpapers;

use App\Models\Wallpaper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreWallpaperRequest extends FormRequest
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
            'image'       => 'required',
            'video'       => [
                'nullable',
                'file',
                'mimes:3gp,3g2,h261,h263,h264,jpgv,jpm,jpgm,mj2,mjp2,mp4,mp4v,mpg4,mpeg,mpg,mpe,m1v,m2v,ogv,qt,mov,uvh,uvvh,uvm,uvvm,uvp,uvvp,uvs,uvvs,uvv,uvvv,dvb,fvt,mxu,m4u,pyv,uvu,uvvu,viv,webm,f4v,fli,flv,m4v,mkv,mk3d,mks,mng,asf,asx,vob,wm,wmv,wmx,wvx,avi,movie,smv,ice',
                'max:200000'
            ]
        ];
    }
}
