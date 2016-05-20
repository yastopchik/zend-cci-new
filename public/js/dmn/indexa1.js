var req = ["0", "2", "6", "8", "11", "14"];
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
        if (modalBody.length) {
            modalBody.append('<label for="exOrg">Организация:</label><select class="form-control" id="exOrg"></select>');
            $.ajax({
                url: 'getexorganization?id=1',
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
                    url: 'getexexecutors?id=' + selectedVal,
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
            })
            modalHelp.find('.modal-footer').prepend('<button type="button" class="btn btn-primary" id="exSubmit">Выбрать</button>');
        }
    }
    $('#exSubmit').on('click', function () {
        exUser = $("select#exUser option:selected").attr('value');
        if (!!exUser)
            modalHelp.modal('hide');
        else
            Message.error('Не выбраны организация или представитель организации');
    })
    $("#requestlist").jqGrid({
        regional: 'ru',
        url: 'getaddrequest',
        datatype: "json",
        colNames: ['Наименование', 'Значение'],
        colModel: [
            {name: 'name', index: 'name', editable: false, sortable: false, width: 400},
            {
                name: 'value', index: 'value', editable: true, editrules: {
                custom: true,
                custom_func: function (value) {
                    return validReq(value, $("#requestlist").jqGrid('getGridParam', 'selrow'));
                }
            },
                edittype: "text", sortable: false, width: 560
            },

        ],
        rowNum: 15,
        sortname: 'item',
        autowidth: true,
        shrinkToFit: true,
        height: '100%',
        viewrecords: true,
        sortorder: "asc",
        multiselect: false,
        onSelectRow: function (id) {
            if (id && id !== lastSel) {
                $('#requestlist').jqGrid('restoreRow', lastSel);
                lastSel = id;
            }
            $('#requestlist').jqGrid('editRow', id, true);
        },
        editurl: "addrequest",
        caption: "Добавление заявки"
    });
    $("#requestlist_d").jqGrid("clearGridData", true).trigger("reloadGrid");
    $("#requestlist_d").jqGrid({
        regional: 'ru',
        url: 'getaddrequestdesc',
        datatype: "json",
        colNames: ['Id', 'П/н №', 'К-во мест и вид упак.', 'Описание товара', 'Критерий', 'Кол-во товара', 'Ед.изм.', 'Номер и дата счета-фактуры'],
        colModel: [{name: 'id', index: 'id', width: '2%', hidden: true},
            {name: 'paragraph', index: 'paragraph', width: '5%', editable: true},
            {name: 'seats', index: 'seats', width: '20%', editable: true},
            {
                name: 'description',
                index: 'description',
                width: '32%',
                editable: true,
                edittype: "textarea",
                editoptions: {rows: "3", cols: "30"}
            },
            {name: 'hscode', index: 'hscode', width: '6%', editable: true},
            {name: 'quantity', index: 'quantity', width: '15%', editable: true},
            {name: 'unit', index: 'unit', width: '10%', editable: true},
            {name: 'invoce', index: 'invoce', width: '10%', editable: true}
        ],
        rowNum: 10,
        autowidth: true,
        shrinkToFit: true,
        height: '100%',
        rowList: [10, 20, 30],
        pager: '#prequestlist_d',
        sortname: 'item',
        viewrecords: true,
        sortorder: "asc",
        multiselect: false,
        editurl: "addrequestdesc",
        caption: "Дополнительная информация по заявке"
    });
    $("#requestlist_d").jqGrid('navGrid', '#prequestlist_d', {add: true, edit: true, del: false, search: false},
        {
            closeAfterEdit: true,
            width: '50%',
            reloadAfterSubmit: true,
            beforeShowForm: function (form) {
                var dlgDiv = $("#editmodrequestlist_d");
                var parentDiv = dlgDiv.parent();
                var dlgWidth = dlgDiv.width();
                var parentWidth = parentDiv.width();
                var parentLeft = parentDiv.offset().left;
                dlgDiv[0].style.top = "100px";
                dlgDiv[0].style.left = Math.round(parentLeft + (parentWidth - dlgWidth  ) / 2) + "px";
            },
        },
        {
            closeAfterAdd: true,
            rowID: "new_row",
            position: "last",
            useDefValues: true,
            width: '50%',
            reloadAfterSubmit: true,
            beforeShowForm: function (form) {
                var dlgDiv = $("#editmodrequestlist_d");
                var parentDiv = dlgDiv.parent();
                var dlgWidth = dlgDiv.width();
                var parentWidth = parentDiv.width();
                var parentLeft = parentDiv.offset().left;
                dlgDiv[0].style.top = "100px";
                dlgDiv[0].style.left = Math.round(parentLeft + (parentWidth - dlgWidth  ) / 2) + "px";
            },
        }
    );
    $('#add').on("click", function (e) {
        e.preventDefault();
        var requestlist = $('#requestlist');
        var validate;
        var isvalid = true;
        if (!!exUser) {
            if (requestlist.length) {
                req.forEach(function (item) {
                    validate = requestlist.find('tr#' + item).find('td[aria-describedby="requestlist_value"]').text();
                    if (validate.length <= 1) {
                        Message.error(requestlist.find('tr#' + item).find('td[aria-describedby="requestlist_name"]').text() + ' - не заполнено!');
                        isvalid = false;
                    }
                });
            }
            if (isvalid) {
                $("#loadImg").show();
                $.ajax({
                    dataType: 'json',
                    url: 'save?id=' + exUser,
                    success: function (jsondata) {
                        $("#loadImg").hide();
                        Message.success('Заявка на сертификат принята');
                        $(location).attr('href', '/dmnrequest');
                    }
                });
            }
        } else {
            $("#loadImg").hide();
            Message.error('Не выбраны организация и клиент');
            return false;
        }
    });
});
function validReq(value, id) {
    var a = req.indexOf(id);
    if ((a >= 0) && (value.length == 0)) {
        Message.error('Значение поля не может быть пустым');
        return [false, ""];
    } else {
        return [true, ""];
    }
}
