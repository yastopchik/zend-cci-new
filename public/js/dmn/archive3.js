$(function () {
    var lastSel;
    $("#requestlist_n").jqGrid({
        regional: 'ru',
        url: "getrequestnumber?isarch=1",
        datatype: "json",
        colNames: ['ID', '№Сертиф.', 'Дата', '№Бланка', 'Файл', 'Статус', 'Исполнитель', 'Должность Исполнителя', 'Телефон Исполн', 'Email Исполн'],
        colModel: [{name: 'id', index: 'id', width: '2%', search: false, hidden: true},
            {name: 'workorder', index: 'workorder', width: '14%', searchoptions: {sopt: ['eq']}},
            {name: 'dateorder', index: 'dateorder', width: '7%',
                searchoptions: {
                    sopt: ['eq'],
                    dataInit: function (el) {
                        setTimeout(function () {
                            $(el).datepicker({dateFormat: "dd/mm/yy"});
                        }, 200);
                    }
                },
            },
            {name: 'numblank', index: 'numblank', width: '11%', searchoptions: {sopt: ['eq']}},
            {name: 'file', index: 'file', width: '14%', editable: false},
            {name: 'status', index: 'status', width: '10%', stype: 'select',
                searchoptions: {
                dataUrl: 'dmnrequest/getstatus',
                style: "width:98%",
                buildSelect: function (data) {
                    var response = $.parseJSON(data);
                    var s = '<select>';
                    if (response && response.length) {
                        for (var i = 0, l = response.length; i < l; i++) {
                            var ri = response[i];
                            s += '<option value="' + ri.id + '">' + ri.status + '</option>';
                        }
                    }
                    return s + "</select>";
                }
            },},
            {name: 'executor', index: 'executor', width: '17%', search: false},
            {name: 'execposition', index: 'execposition', width: '16%', search: false},
            {name: 'execphone', index: 'execphone', width: '10%', search: false},
            {name: 'execemail', index: 'execemail', width: '12%', search: false}
        ],
        cmTemplate: {sortable: false},
        rowNum: 5,
        rowList: [5, 10, 20, 30],
        autowidth: true,
        shrinkToFit: true,
        height: '20%',
        pager: '#prequestlist_n',
        sortname: 'id',
        multiselect: false,
        viewrecords: true,
        sortorder: "desc",
        onSelectRow: function () {
            var ids = $("#requestlist_n").jqGrid('getGridParam', 'selrow');
            if (ids != null) {
                $("#requestlist").jqGrid('setGridParam', {url: 'getrequest?isarch=1&id=' + ids, page: 1});
                $("#requestlist").jqGrid('setCaption', "Детализированная информация по заявке №: " + ids)
                    .trigger('reloadGrid');
                $("#requestlist_d").jqGrid('setGridParam', {url: 'getrequestdesc?isarch=1&id=' + ids, page: 1});
                $("#requestlist_d").jqGrid('setCaption', "Дополнительная информация по заявке №: " + ids)
                    .trigger('reloadGrid');
            } else {
                ids = 0;
                if ($("#requestlist").jqGrid('getGridParam', 'records') > 0) {
                    $("#requestlist").jqGrid('setGridParam', {url: 'getrequest?isarch=1&id=' + ids, page: 1});
                    $("#requestlist").jqGrid('setCaption', "Детализированная информация по заявке №: " + ids)
                        .trigger('reloadGrid');
                }
                if ($("#requestlist_d").jqGrid('getGridParam', 'records') > 0) {
                    $("#requestlist_d").jqGrid('setGridParam', {
                        url: 'requests/getrequestdesc?id=' + ids,
                        page: 1
                    });
                    $("#requestlist_d").jqGrid('setCaption', "Дополнительная информация по заявке №: " + ids)
                        .trigger('reloadGrid');
                }
            }
        },
        caption: "Архив заявок"
    });
    $("#requestlist_n").jqGrid('navGrid', "#prequestlist_n", {edit: false, add: false, del: false, search: true},
        {}, {}, {},
        {
            closeOnEscape: true,
            multipleSearch: true,
            closeAfterSearch: true,
        }
    );
    $("#requestlist").jqGrid({
        regional: 'ru',
        url: 'getrequest?isarch=1&id=0',
        datatype: "json",
        colNames: ['Наименование', 'Значение', 'IdReq'],
        colModel: [
            {name: 'name', index: 'name', editable: false, sortable: false, width: '40%'},
            {name: 'value', index: 'value', editable: false, sortable: false, width: '60%'},
            {name: 'idreq', index: 'idreq', hidden: true, editable: false}
        ],
        cmTemplate: {sortable: false},
        rowNum: 15,
        pager: '#prequestlist',
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
        caption: "Детализация заявки",
        gridComplete: function () {
            var recs = parseInt($("#requestlist").getGridParam("records"), 10);
            if (isNaN(recs) || recs == 0) {
                $("#gridWrapper").hide();
            }
            else {
                $('#gridWrapper').show();
            }
        }
    });
    $("#requestlist").jqGrid('navGrid', "#prequestlist", {edit: false, add: false, del: false, search: false},
        {}, {}, {},
        {
            closeOnEscape: true,
            multipleSearch: true,
            closeAfterSearch: true,
        });
    $("#requestlist_d").jqGrid({
        regional: 'ru',
        url: 'getrequestdesc?isarch=1&id=0',
        datatype: "json",
        colNames: ['Id', 'П/н №', 'К-во мест и вид упак.', 'Описание товара', 'Критерий', 'Кол-во товара', 'Ед.изм.', 'Номер и дата счета-фактуры'],
        colModel: [{name: 'id', index: 'id', width: '2%', hidden: true},
            {name: 'paragraph', index: 'paragraph', width: '5%'},
            {name: 'seats', index: 'seats', width: '20%'},
            {name: 'description', index: 'description', width: '32%'},
            {name: 'hscode', index: 'hscode', width: '6%'},
            {name: 'quantity', index: 'quantity', width: '15%'},
            {name: 'unit', index: 'unit', width: '10%'},
            {name: 'invoce', index: 'invoce', width: '10%'}
        ],
        cmTemplate: {sortable: false},
        rowNum: 15,
        autowidth: true,
        shrinkToFit: true,
        height: '100%',
        rowList: [10, 20, 30],
        pager: '#prequestlist_d',
        sortname: 'item',
        viewrecords: true,
        sortorder: "asc",
        multiselect: false
    });
    $("#requestlist_d").jqGrid('navGrid', '#prequestlist_d', {add: false, edit: false, del: false, search: false},
        {}, {}, {},
        {
            closeOnEscape: true,
            multipleSearch: true,
            closeAfterSearch: true,
        });
});