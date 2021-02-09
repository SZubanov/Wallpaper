@extends('base')

@section('page')
    <div class="card card-default">
        <div class="card-body">
            <form action="{{ $formRoute ?? '' }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method($formMethod ?? 'POST')
{{--                    @dd($errors)--}}
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
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image">
                                Изображение
                            </label>
                            <div class="custom-file">
                                <input name="image[]" type="file"
                                       class="{{ $errors->has('image') ? 'is-invalid' : '' }}"
                                       id="validatedCustomFile" accept=".jpg,.jpeg,.png,.webp"
                                       data-id="image" multiple
                                       @if ($method == 'create') required @endif>
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
