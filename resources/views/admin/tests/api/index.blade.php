@extends('base')

@section('page')
    <div class="card card-default">
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">
                            @lang('users.create.email')
                        </label>
                        <input type="email" required
                               class="form-control"
                               name="email" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="password">
                            @lang('users.create.password')
                        </label>
                        <input type="password"
                               class="form-control"
                               name="password" autocomplete="off">
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary" onclick="ApiTest.login('{{ route('api.login') }}')">@lang('test.api.index.send')</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">
                            @lang('test.api.index.api_token')
                        </label>
                        <input type="text" required
                               class="form-control"
                               name="token" autocomplete="off">
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary" onclick="ApiTest.weather('{{ route('api.weather') }}')">@lang('test.api.index.send')</button>
                        </div>
                    </div>
                </div>

                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col-12">
                    <textarea id="result" class="form-control" rows="10" disabled></textarea>
                </div>
            </div>

        </div>
    </div>
@stop
