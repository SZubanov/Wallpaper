@extends('base')

@section('page')
    <div class="card card-default">
        <div class="card-body">
            <form action="{{ $formRoute ?? '' }}" method="POST">
                @csrf
                @method($formMethod ?? 'POST')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">
                                @lang('users.create.email')
                            </label>
                            <input type="email" required value="{{ old('email') ?? ($user->email ?? '') }}"
                                   class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                   name="email" autocomplete="off">
                            @if($errors->has('email'))
                                <div class="error invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password">
                                @lang('users.create.password')
                            </label>
                            <input type="password"
                                   class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                   name="password" autocomplete="off">
                            @if($errors->has('password'))
                                <div class="error invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation ">
                                @lang('users.create.password_confirmation')
                            </label>
                            <input type="password"
                                   class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                   name="password_confirmation" autocomplete="off">
                            @if($errors->has('password_confirmation'))
                                <div class="error invalid-feedback">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row">
                    <div class="col-12">
                        @include('includes.buttons-form', ['cancelRoute' => route('users.index')])
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
