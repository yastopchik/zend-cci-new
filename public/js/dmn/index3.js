$(function () {
    var lastSel;
    $("#requestlist_n").jqGrid({
        regional: 'ru',
        url: "requests/getrequestnumber",
        datatype: "json",
        colNames: ['ID', '№Сертиф.', 'Дата', '№Бланка', 'Файл', 'Статус', 'Исполнитель', 'Должность Исполнителя', 'Телефон Исполн', 'Email Исполн', 'Действия'],
        colModel: [{name: 'id', index: 'id', width: '2%', search: false, hidden: true},
            {name: 'workorder', index: 'workorder', width: '14%', searchoptions: {sopt: ['eq']}},
            {
                name: 'dateorder', index: 'dateorder', width: '7%',
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
            {
                name: 'status', index: 'status', width: '10%', stype: 'select',
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
                },
            },
            {name: 'executor', index: 'executor', width: '17%', search: false},
            {name: 'execposition', index: 'execposition', width: '16%', search: false},
            {name: 'execphone', index: 'execphone', width: '10%', search: false},
            {name: 'execemail', index: 'execemail', width: '12%', search: false},
            {name: 'act', index: 'act', width: '7%', sortable: false, search: false}
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
                $("#requestlist").jqGrid('setGridParam', {url: 'requests/getrequest?id=' + ids, page: 1});
                $("#requestlist").jqGrid('setCaption', "Детализированная информация по заявке №: " + ids)
                    .trigger('reloadGrid');
                $("#requestlist_d").jqGrid('setGridParam', {url: 'requests/getrequestdesc?id=' + ids, page: 1});
                $("#requestlist_d").jqGrid('setCaption', "Дополнительная информация по заявке №: " + ids)
                    .trigger('reloadGrid');
            } else {
                ids = 0;
                if ($("#requestlist").jqGrid('getGridParam', 'records') > 0) {
                    $("#requestlist").jqGrid('setGridParam', {url: 'requests/getrequest?id=' + ids, page: 1});
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
        gridComplete: function () {
            var ids = $("#requestlist_n").jqGrid('getDataIDs');
            for (var i = 0; i < ids.length; i++) {
                var cl = ids[i];
                xls = '<a href="#"  class="btn btn-success btn-sm download" data-type="text" data-href="requests/downloadxls?id=' + cl + '">' +
                    '<i class="fa fa-file-excel-o" title="Выгрузить в xls шаблон" aria-hidden="true"></i></a>';
                lifecycle = '<a href="#" class="btn btn-warning btn-sm lifecycle"  data-href="requests/getlifecycle?id=' + cl + '">' +
                    '<i class="fa fa-life-ring" title="Жизненный цикл заявки" aria-hidden="true"></i></a>';
                $("#requestlist_n").jqGrid('setRowData', ids[i], {act: xls + lifecycle});
            }
        },
        caption: "Заявки Организации"
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
        url: 'requests/getrequest?id=0',
        datatype: "json",
        colNames: ['Наименование', 'Значение', 'IdReq'],
        colModel: [
            {name: 'name', index: 'name', editable: false, sortable: false, width: '40%'},
            {name: 'value', index: 'value', sortable: false, width: '60%'},
            {name: 'idreq', index: 'idreq', hidden: true}
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
        url: 'requests/getrequestdesc?id=0',
        datatype: "json",
        colNames: ['Id', 'П/н №', 'К-во мест и вид упак.', 'Описание товара', 'Критерий', 'Кол-во товара', 'Ед.изм.', 'Номер и дата счета-фактуры'],
        colModel: [{name: 'id', index: 'id', width: '2%', hidden: true},
            {name: 'paragraph', index: 'paragraph', width: '5%'},
            {name: 'seats', index: 'seats', width: '20%'},
            {name: 'description', index: 'description', width: '32%',},
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