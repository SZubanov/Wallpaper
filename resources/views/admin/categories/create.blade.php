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
                            <label for="emoji">
                                Эмодзи
                            </label>
                            <input type="text"  value="{{ old('emoji') ?? ($category->emoji ?? '') }}"
                                   class="form-control {{ $errors->has('emoji') ? 'is-invalid' : '' }}"
                                   name="emoji" autocomplete="off">
                            @if($errors->has('emoji'))
                                <div class="error invalid-feedback">
                                    <strong>{{ $errors->first('emoji') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="name_ru">
                                Название (RU)<sup class="text-danger">*</sup>
                            </label>
                            <input type="text" value="{{ old('name_ru') ?? ($category->name_ru ?? '') }}"
                                   class="form-control {{ $errors->has('name_ru') ? 'is-invalid' : '' }}"
                                   name="name_ru" autocomplete="off" required>
                            @if($errors->has('name_ru'))
                                <div class="error invalid-feedback">
                                    <strong>{{ $errors->first('name_ru') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="name_en">
                                Name (EN)
                            </label>
                            <input type="text" value="{{ old('name_en') ?? ($category->name_en ?? '') }}"
                                   class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}"
                                   name="name_en" autocomplete="off">
                            @if($errors->has('name_en'))
                                <div class="error invalid-feedback">
                                    <strong>{{ $errors->first('name_en') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="rating">
                                Рейтинг
                            </label>
                            <input type="number" value="{{ old('rating') ?? ($category->rating ?? '') }}"
                                   class="form-control {{ $errors->has('rating') ? 'is-invalid' : '' }}"
                                   name="rating" autocomplete="off">
                            @if($errors->has('rating'))
                                <div class="error invalid-feedback">
                                    <strong>{{ $errors->first('rating') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="sort">
                                Позиция
                            </label>
                            <input type="number" value="{{ old('sort') ?? ($category->sort ?? '') }}"
                                   class="form-control {{ $errors->has('sort') ? 'is-invalid' : '' }}"
                                   name="sort" autocomplete="off">
                            @if($errors->has('sort'))
                                <div class="error invalid-feedback">
                                    <strong>{{ $errors->first('sort') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="sort">
                                Активно
                            </label>
                            <input type="hidden" value="0"
                                   name="is_active">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="is_active" class="custom-control-input" id="customSwitch1" value="1"
                                       @if(isset($category) and $category->is_active) checked @endif
                                >
                                <label class="custom-control-label" for="customSwitch1">Включить</label>
                            </div>
                        </div>

                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image">
                                Изображение
                            </label>
                            <div class="custom-file">
                                <input name="image" type="file" class="custom-file-input {{ $errors->has('image') ? 'is-invalid' : '' }}" id="validatedCustomFile" accept=".jpg,.jpeg,.png,.webp"
                                       data-id="image"
                                >
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
                               @if ($method == 'update' and !is_null($category->media))
                               href="{{ $category->getFirstMediaUrl() }}"
                               @else
                               href=""
                                @endif
                            >
                                <img class="card-img-top "
                                     @if ($method == 'update' and !is_null($category->media))
                                     src="{{ $category->getFirstMediaUrl() }}"
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
                        @include('includes.buttons-form', ['cancelRoute' => route('categories.index')])
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
