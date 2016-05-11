$(function () {
    var lastSel;
    var modalHelp = $("#modalHelp");
    if (modalHelp.length) {
        var modalDialog = modalHelp.find('.modal-dialog');
        modalDialog.removeClass('modal-lg').addClass('');
        modalHelp.find('.modal-title').html('Необходимо выбрать организацию');
        modalHelp.modal();
        var modalBody = modalHelp.find('.modal-body');
        if (modalBody.length) {
            modalBody.append('<select class="form-control" id="exOrg"></select>');
            $.ajax({
                url: 'dmnrequest/getexorganization?id=1',
                dataType: 'text',
                success: function (response) {
                    response = JSON.parse(response);
                    var exOrg = '<option value="0">--Необходимо выбрать организацию--</option>';
                    if (response.length) {
                        for (var i = 0, l = response.length; i < l; i++) {
                            var ri = response[i];
                            exOrg += '<option value="' + ri.id + '">' + ri.name + '</option>';
                        }
                    }
                    $('#exOrg').html(exOrg);
                },
            });
            $("#exOrg").change(function () {
                var selectedVal = $("#exOrg :selected").val();
                var selectExUser = modalBody.find('#exUser');
                if(selectExUser.length)
                    selectExUser.remove();
                    modalBody.append('<select class="form-control" id="exUser"></select>');
                $.ajax({
                    url: 'dmnrequest/getexexecutors?id=' + selectedVal,
                    dataType: 'text',
                    success: function (response) {
                        response = JSON.parse(response);
                        if (response.length) {
                            for (var i = 0, l = response.length; i < l; i++) {
                                var ri = response[i];
                                exUser += '<option value="' + ri.id + '">' + ri.executor + '</option>';
                            }
                        }
                        $('#exUser').html(exUser);
                    },
                });
            })
            modalHelp.find('.modal-footer').prepend('<button type="button" class="btn btn-primary" id="changePassSubmit">Выбрать</button>');
        }
    }
});