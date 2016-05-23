$(function () {
    var lastSel, exUser;
    var modalHelp = $("#modalHelp");
    if (modalHelp.length) {
        var modalDialog = modalHelp.find('.modal-dialog');
        modalDialog.removeClass('modal-lg').addClass('');
        modalDialog.find('.close').remove();
        modalDialog.find('#buttonClose').remove();
        modalHelp.find('.modal-title').html('Выбирете необходимые данные');
        modalHelp.modal();
        var modalBody = modalHelp.find('.modal-body');
        var modalFooter = modalHelp.find('.modal-footer');
        if (modalBody.length) {
            modalBody.empty();
            modalFooter.empty();
            modalBody.append('<label for="exOrg">Организация:</label><select class="form-control" id="exOrg"></select>');
            $.ajax({
                url: 'dmnrequest/getexorganization?id=1',
                dataType: 'text',
                success: function (response) {
                    response = JSON.parse(response);
                    $('#exOrg').append('<option value="0">--Необходимо выбрать организацию--</option>');
                    if (response.length) {
                        for (var i = 0, l = response.length; i < l; i++) {
                            var ri = response[i];
                            $('#exOrg').append('<option value="' + ri.id + '">' + ri.name + '</option>');
                        }
                    }
                },
            });
            $("#exOrg").change(function () {
                var selectedVal = $("#exOrg :selected").val();
                var selectExUser = modalBody.find('#exUser');
                var exUser;
                if (!selectExUser.length) {
                    modalBody.append('<label for="exUser">Предстваитель:</label><select class="form-control" id="exUser"></select>');
                }
                selectExUser.empty();
                $.ajax({
                    url: 'dmnrequest/getexexecutors?id=' + selectedVal,
                    dataType: 'text',
                    success: function (response) {
                        response = JSON.parse(response);
                        if (response.length) {
                            for (var i = 0, l = response.length; i < l; i++) {
                                var ri = response[i];
                                $('#exUser').append('<option value="' + ri.id + '">' + ri.executor + '</option>');
                            }
                        }
                    },
                });
            });
            modalFooter.append('<button type="button" class="btn btn-primary" id="exSubmit">Выбрать</button>' +
                '<button type="button" id="buttonClose" class="btn btn-default" data-dismiss="modal">Закрыть</button>');

        }
    }
    $('#exSubmit').on('click', function(){
        exUser = $("select#exUser option:selected").attr('value');
        if(!!exUser)
            modalHelp.modal('hide');
        else
            Message.error('Не выбраны организация или представитель организации');
    })
    var uploader = $('#uploader');
    if (uploader.length) {
        var href = uploader.data('href');
        uploader.plupload({
            // General settings
            runtimes: 'html5,flash,silverlight,html4',
            url: href,
            // Maximum file size
            max_file_size: '15mb',
            max_file_count: 10,
            multi_selection: true,
            chunk_size: '1mb',
            resize: {
                width: 200,
                height: 200,
                quality: 90,
                crop: true // crop to exact dimensions
            },
            filters: [
                {title: "Excel files", extensions: "xls,xlsx"}
            ],
            // Sort files
            sortable: false,
            dragdrop: false,
            // Views to activate
            views: {
                list: true,
                thumbs: true, // Show thumbs
                active: 'thumbs'
            },
        });
        var uploader = uploader.plupload('getUploader');
        uploader.bind('BeforeUpload', function (up, file) {
            if (exUser){
                var splitSetting = up.settings.url.split('?');
                up.settings.url = splitSetting[0] + "?id=" + exUser;
            }
            else
                Message.error('Не выбраны организация или представитель организации');
        });
        uploader.bind('FileUploaded', function (up, file, response) {
            response = $.parseJSON(response.response);
            if (!!response.error) {
                if (!!response.error.code) {
                    $.each(response.error.message, function(i, val) {
                        uploader.trigger('Error', {
                            code: response.error.code,
                            message: val
                        });

                    });
                }
            }
            if ((uploader.total.uploaded + 1) >= uploader.files.length && (typeof response.error === 'undefined')) {
                window.location = '/';
            }
        });
    }
});