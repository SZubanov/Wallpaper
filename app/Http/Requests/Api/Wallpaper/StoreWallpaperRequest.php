<?php

namespace App\Http\Requests\Api\Wallpaper;

use App\Http\Requests\Wallpapers\StoreWallpaperRequest as AdminStoreWallpaperRequest;

class StoreWallpaperRequest extends AdminStoreWallpaperRequest
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
        $fields = parent::rules();
        $fields['video'] = [
            'nullable',
            'file',
            'mimes:3gp,3g2,h261,h263,h264,jpgv,jpmjpgm,mj2,mjp2,mp4,mp4v,mpg4,mpeg,mpg,mpe,m1v,m2v,ogv,qt,mov,uvh,uvvh,uvm,uvvm,uvp,uvvp,uvs,uvvs,uvv,uvvv,dvb,fvt,mxu,m4u,pyv,uvu,uvvu,viv,webm,f4v,fli,flv,m4v,mkv,mk3d,mks,mng,asf,asx,vob,wm,wmv,wmx,wvx,avi,movie,smv,ice',
            'max:200000'
        ];

        return $fields;
    }
}
