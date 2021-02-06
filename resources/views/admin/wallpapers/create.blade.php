@extends('base')

@section('page')
    <div class="card card-default">
        <div class="card-body">
            <form action="{{ $formRoute ?? '' }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method($formMethod ?? 'POST')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category_id">
                                Категория<sup class="text-danger">*</sup>
                            </label>
                            <select name="category_id" class="form-control"
                                    required
                            >
                                @if($categories->isNotEmpty())
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                                @if((old('category_id') and old('category_id') == $category->id)
                                                    || (isset($wallpaper) and $wallpaper->category_id == $category->id))
                                                selected
                                            @endif
                                        >
                                            {{ $category->name_ru }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @if($errors->has('category_id'))
                                <div class="error invalid-feedback">
                                    <strong>{{ $errors->first('category_id') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="device">
                                Устройство<sup class="text-danger">*</sup>
                            </label>
                            <select name="device" class="form-control"
                                    required
                            >
                                @if($devices)
                                    @foreach($devices as $id => $name)
                                        <option value="{{ $id }}"
                                                @if((old('device') and old('device') == $id)
                                                    || (isset($wallpaper) and $wallpaper->device == $id))
                                                selected
                                            @endif
                                        >
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @if($errors->has('category_id'))
                                <div class="error invalid-feedback">
                                    <strong>{{ $errors->first('category_id') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="caption_ru">
                                Описание (RU)
                            </label>
                            <input type="text" value="{{ old('caption_ru') ?? ($wallpaper->caption_ru ?? '') }}"
                                   class="form-control {{ $errors->has('caption_ru') ? 'is-invalid' : '' }}"
                                   name="caption_ru" autocomplete="off">
                            @if($errors->has('caption_ru'))
                                <div class="error invalid-feedback">
                                    <strong>{{ $errors->first('caption_ru') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="caption_en">
                                Caption (EN)
                            </label>
                            <input type="text" value="{{ old('caption_en') ?? ($wallpaper->caption_en ?? '') }}"
                                   class="form-control {{ $errors->has('caption_en') ? 'is-invalid' : '' }}"
                                   name="caption_en" autocomplete="off">
                            @if($errors->has('caption_en'))
                                <div class="error invalid-feedback">
                                    <strong>{{ $errors->first('caption_en') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image">
                                Изображение
                            </label>
                            <div class="custom-file">
                                <input name="image" type="file"
                                       class="custom-file-input {{ $errors->has('image') ? 'is-invalid' : '' }}"
                                       id="validatedCustomFile" accept=".jpg,.jpeg,.png,.webp"
                                       data-id="image"
                                       @if ($method == 'create') required @endif>
                                <label class="custom-file-label" for="validatedCustomFile" data-browse="Обзор"></label>
                                @if($errors->has('image'))
                                    <div class="error invalid-feedback">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <a id="image" class="fancybox"
                               @if ($method == 'update' and !is_null($wallpaper->media))
                               href="{{ $wallpaper->getFirstMediaUrl() }}"
                               @else
                               href=""
                                @endif
                            >
                                <img class="card-img-top "
                                     @if ($method == 'update' and !is_null($wallpaper->media))
                                     src="{{ $wallpaper->getFirstMediaUrl() }}"
                                     @else
                                     src=""
                                    @endif
                                >
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        @include('includes.buttons-form', ['cancelRoute' => route('wallpapers.index')])
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop