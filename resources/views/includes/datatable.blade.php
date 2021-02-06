<table id="table"
       data-type="{{$dataType ?? 'datatable'}}"
       data-url="{{ $tableRoute ?? '' }}"
       class="table table-hover text-nowrap"
       data-columns="{{ $jsonColumns ?? '' }}"
       data-search="{{ $tableSearchSelector ?? '#table-search' }}"
       data-filter="{{ $filterForm ?? '#datatable-form' }}"
       style="width: 100%;">
    <thead>
    <tr>
        @if(isset($columns))
            @foreach($columns as $column)
                <th>{{ $column['caption'] }}</th>
            @endforeach
        @endif
    </tr>
    </thead>
</table>
