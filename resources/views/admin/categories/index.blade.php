@extends('base')

@section('page')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header no-border-bottom">
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary">
                                Добавить
                            </a>
                        </div>
                        <div class="card-tools">
                            <div class="input-group input-group-sm" id="table-search">
                                <input type="text" name="table_search" class="form-control float-right"
                                       placeholder="Название">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <form id="datatable-form" class="form-inline">
                    </form>
                    @include('includes.datatable')
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@stop
