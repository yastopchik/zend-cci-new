var req = ["0", "2", "6", "8", "11", "14"];
$(function () {
    var lastSel;
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
});
$('#add').on("click", function () {
    var requestlist = $('#requestlist');
    var validate;
    if (requestlist.length){
        req.forEach(function(item) {
            validate=requestlist.find('tr#'+item).find('td[aria-describedby="requestlist_value"]').text();
            if (validate.length <= 1){
                Message.error(requestlist.find('tr#'+item).find('td[aria-describedby="requestlist_name"]').text() + ' - не заполнено!');
                return false;
            }
        });
    }
    $("#loadImg").show();
    $.ajax({
         dataType: 'json',
            url: 'save',
            success: function(jsondata){
                $("#loadImg").hide();
                Message.success('Заявка на сертификат принята');
                $(location).attr('href', '/requests');
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
