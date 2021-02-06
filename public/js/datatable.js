$.fn.dataTable.ext.errMode = 'none'; // отключим alert при ошибке datatable

DatatableHelper = {
    deleteButton: element => {
        const button = $(element);
        const route = button.data('route');
        const message = button.data('message') ?? null;
        const successMessage = button.data('success-message') ?? null;

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success m-1',
                cancelButton: 'btn btn-danger m-1'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Вы уверены?',
            text: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Да, удалить',
            cancelButtonText: 'Нет, не удалять',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                const data =  {_method: 'DELETE', _token: config.token};
                const success =  function (data) {
                    if (data.success) {
                        DatatableHelper.reload(null, null, element);
                        swalWithBootstrapButtons.fire(
                            'Удалили!',
                            successMessage,
                            'success'
                        )
                    }

                    if (data.error) {
                        swalWithBootstrapButtons.fire(
                            'Ошибка!',
                            data.error,
                            'error'
                        )
                    }

                };

                Model.ajax_request(route, data, 'POST', success)
            }
        })
    },

    reload: (id = null, selector = null, closest = null) => {
        if(id != null){
            $('#' + id).DataTable().ajax.reload(null, false);
        }
        else if(selector != null){
            $(selector).find(".dataTables_wrapper").each(function (key, value) {
                let id = $(value).attr('id').replace('_wrapper', '');
                $('#' + id).DataTable().ajax.reload(null, false);
            })
        }
        else if(closest != null){
            $(closest).closest(".dataTables_wrapper").each(function (key, value) {
                let id = $(value).attr('id').replace('_wrapper', '');
                $('#' + id).DataTable().ajax.reload(null, false);
            })
        }
        else {
            $(".dataTables_wrapper").each(function (key, value) {
                let id = $(value).attr('id').replace('_wrapper', '');
                $('#' + id).DataTable().ajax.reload(null, false);
            })
        }
    },

    create: function (table) {
        const datatable = table.dataTable({
            // width: '100%',
            pageLength: config.pagination,
            processing: true,
            serverSide: true,
            scrollX: true,
            fixedColumns: true,
            stateSave: true,
            order: [table.data('order') != undefined? table.data('order'):[1,'asc']],
            buttons: [
                {
                    extend: 'colvis',
                    text: 'Настройки таблицы',
                },
            ],
            // sDom: '<"float-right"B><"top">rt<"bottom"p><"clear">',
            sDom: 'tr<"bottom"p>',
            columns: table.data('columns'),
            ajax: {
                url: table.data('url'),
                data: function (d) {
                    return DatatableHelper.getFilters(table.data('filter'), d);
                },

            },
            language: {
                processing: 'Подождите...',
                info: 'Отображены строки <b> _START_ — _END_</b>. Всего в базе <b>_TOTAL_</b>.',
                infoEmpty: 'Ничего не найдено.',
                infoFiltered: " (Отфильтрованно из <b>_MAX_</b> записей)",
                zeroRecords: 'Ничего не найдено.',
                emptyTable: 'Не найдено результатов',
                paginate: {
                    first: 'Первый',
                    previous: '«',
                    next: '»',
                    last: '«',
                },
            },
            fnDrawCallback: function (oSettings) {

            },

        });



        datatable.on('error', function ( e, settings, techNote, message ) {
            console.log(message);
        });

        const searchBlock = $(table.data('search'))

        searchBlock.find('input').off('keyup').keyup(function (event) {
            $(table).DataTable().search($(this).val()).ajax.reload(null, false);
        });

        searchBlock.find('button').off('click').click(function (event) {
            $(table).DataTable().search(searchBlock.find('input').val()).ajax.reload(null, false);
        });

        $(table.data('filter')).find('select').change(function(){
            $(table).DataTable().ajax.reload(null, false);
        });

        $(table.data('filter')).find('input').change(function(){
            $(table).DataTable().ajax.reload(null, false);
        });
    },

    getFilters: function (selector, d = {}) {

        let form = $(selector).serializeCustomArray();

        let increment = 0;
        let filters = {};
        for (key in form) {
            if (form[key].type == "select-multiple") {
                let name = form[key].name.replace('[]', '');
                if (!filters[name]) {
                    increment = 0;
                    filters[name] = [];
                }

                filters[name][increment] = form[key].value;
                increment++;
            } else {
                filters[form[key].name] = form[key].value;
            }
        }

        $.extend(d, filters);

        return d;
    },

};
