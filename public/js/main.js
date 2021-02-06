$.fn.serializeCustomArray = function () {
    return this.map(function () {
        let elements = jQuery.prop(this, "elements");
        return elements ? jQuery.makeArray(elements) : this;
    }).filter(function () {
        let type = this.type;
        return this.name && this.value != '' && !jQuery(this).is(':disabled');
    }).map(function (index, element) {
        let rCRLF = /\r?\n/g;
        let type = this.type;

        let val = jQuery(this).val();
        if (val == null)
            return null;


        if (Array.isArray(val)) {
            return jQuery.map(val, function (val) {
                let option_name = jQuery(element).find('option:selected[value="' + val + '"]').text();
                return {type: type, option_name: option_name, name: element.name, value: val.replace(rCRLF, "\r\n")};
            });
        }

        let option_name = jQuery(element).find('option:selected').text();
        if (type == 'select-one')
            return {option_name: option_name, name: element.name, value: val.replace(rCRLF, "\r\n")};

        return {name: element.name, value: val.replace(rCRLF, "\r\n")};
    }).get();
};


$(document).ready(function () {
    $('table[data-type="datatable"]').each(function () {
        DatatableHelper.create($(this));
    });

    const SwallToast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    // Инициализация fancybox
    $(".fancybox").fancybox({
        openEffect: 'elastic',
        closeEffect: 'elastic',
    });
});

// Подставляем изображение после его выбора в инпуте.
$('input[type="file"]').change(function () {
    let attribute = $(this).data('id');
    if ($(this).prop('multiple')) {
        $(this).prev('span').html('(выбрано ' + this.files.length + ' файлов)');
    } else {
        let file = this.files[0];
        let id = $('#' + attribute);
        if (file) {
            id.attr('href', '');
            id.find('img').attr('src', '');
            var reader = new FileReader();
            reader.onload = function (e) {
                id.attr('href', e.target.result);
                id.find('img').attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        }
    }
});


Main = {
    preloaderShow: function () {
        $('#preloader').toggleClass('d-none');
        $('#container-fluid').toggleClass('block-container')
    },
};

Model = {
    ajax_request: function (url, data = {}, method = 'GET', success = function (d) {
    }, error = function (e) {
    }) {
        $.ajax({
            type: method,
            url: url,
            cache: false,
            dataType: 'json',
            data: data,
            success: success,
            error: error
        });
    },

    update: function (form) {
        Main.preloaderShow();
        event.preventDefault();
        let data = $(form).serializeArray();
        let success = function (data) {
            Main.preloaderShow();
            if (data['action'] === 'reload_table') {
                dtListelements.ajax.reload(null, false);
            } else if (data['action'] === 'success') {
                toastr.success(data['success']);
            }
        }

        var error = function (data) {
            $.each(data.responseJSON.errors, function (index, error) {
                toastr.error(error[0]);
            });

            if (data.status && data.status === 403) {
                toastr.error('Недостаточно прав')
            }
        };

        Model.ajax_request(form.action, data, form.method, success, error)
    }
};

ApiTest = {
    login: function (url) {
        let email = $('[name="email"]').val();
        let password = $('[name="password"]').val();

        let data = {email: email, password: password};

        let success = function (data) {
            let str = JSON.stringify(data, undefined, 4);
            document.getElementById('result').innerHTML = str;
        }

        let error = function (data) {
            let str = JSON.stringify(data, undefined, 4);
            document.getElementById('result').innerHTML = str;
        };

        Model.ajax_request(url, data, 'POST', success, error)
    },

    weather: function (url) {

        let token = $('[name="token"]').val();

        let success = function (data) {
            let str = JSON.stringify(data, undefined, 4);
            document.getElementById('result').innerHTML = str;
        }

        let error = function (data) {
            let str = JSON.stringify(data, undefined, 4);
            document.getElementById('result').innerHTML = str;
        };

        $.ajax({
            type: 'GET',
            url: url,
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                "token": token
            },
            cache: false,
            dataType: 'json',
            success: success,
            error: error
        });
    }
}

