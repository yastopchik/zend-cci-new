$(function () {
    var lastSel, country;
    $.getJSON("getcountryjson", function (data) {
        country = data;
    });
    $("#requestlist_n").jqGrid({
        regional: 'ru',
        url: "getrequestnumber?isarch=1",
        datatype: "json",
        colNames: ['ID', '№Сертиф.', 'Дата', '№Бланка', 'Форма', 'Файл', 'Статус', 'КолДопЛист', 'Клиент', 'Должность', 'Телефон', 'Организация', 'Исполнитель', 'СтранаНазн'],
        colModel: [{name: 'id', index: 'id', width: '3%', searchoptions: {sopt: ['eq']}},
            {name: 'workorder', index: 'workorder', width: '8%', searchoptions: {sopt: ['eq']}},
            {name: 'dateorder', index: 'dateorder', width: '6%',
                searchoptions: {
                    sopt: ['eq'],
                    dataInit: function (el) {
                        setTimeout(function () {
                            $(el).datepicker({dateFormat: "dd/mm/yy"});
                        }, 200);
                    }
                }
            },
            {name: 'numblank', index: 'numblank', width: '7%', editable: true, searchoptions: {sopt: ['eq']}},
            {name: 'forms', index: 'forms', width: '6%',
                stype: 'select',
                searchoptions: {
                    dataUrl: 'dmnexrequest/getforms',
                    style: "width:98%",
                    buildSelect: function (data) {
                        var response = $.parseJSON(data);
                        var s = '<select>';
                        if (response && response.length) {
                            for (var i = 0, l = response.length; i < l; i++) {
                                var ri = response[i];
                                s += '<option value="' + ri.id + '">' + ri.forms + '</option>';
                            }
                        }
                        return s + "</select>";
                    }
                },
            },
            {name: 'file', index: 'file', width: '5%' },
            {name: 'status', index: 'status', width: '6%',
                stype: 'select',
                searchoptions: {
                    sopt: ['eq'],
                    dataUrl: 'getstatus',
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
                }
            },
            {name: 'numdoplist', index: 'numdoplist', width: '5%', search: false},
            {name: 'name', index: 'name', width: '6%',
                cellattr: function (rowId, tv, rawObject, cm, rdata) {
                    return 'style="white-space: normal;"'
                }
            },
            {name: 'position', index: 'position', width: '5%',  searchoptions: {sopt: ['eq']}},
            {name: 'phone', index: 'phone', width: '5%'},
            {name: 'organization', index: 'organization', width: '15%', searchoptions: {sopt: ['eq']}},
            {name: 'executor', index: 'executor', width: '10%', sortable: false},
            {name: 'destinationiso', index: 'destinationiso', width: '7%',
                formatter: function (cellValue) {
                    var value = "";
                    if (cellValue) {
                        if (!$.isEmptyObject(country)) {
                            value = country[cellValue];

                        } else if (cellValue == 1) {
                            return "Российская Федерация";
                        } else if (cellValue == 21) {
                            return "Республика Беларусь";
                        } else {
                            $.ajax({
                                dataType: 'json',
                                url: "getcountrybyid?id=" + cellValue,
                                async: false,
                                success: (function (result) {
                                    var cObject = result[0];
                                    value = cObject.nameru;
                                })
                            });
                        }
                    }
                    return value;
                },
                unformat: function (cellValue) {
                    var value = 1;
                    if (cellValue) {
                        $.ajax({
                            dataType: 'json',
                            url: "getcountrybyname?rows=" + cellValue,
                            async: false,
                            success: (function (result) {
                                var cObject = result[0];
                                value = cObject.id;
                            })
                        });
                    }
                    return value;

                },
                stype: 'select',
                searchoptions: {
                    sopt: ['eq'],
                    dataUrl: 'geteditcountries',
                    style: "width:98%",
                    buildSelect: function (data) {
                        var response = $.parseJSON(data);
                        var s = '<select>';
                        if (response && response.length) {
                            for (var i = 0, l = response.length; i < l; i++) {
                                var ri = response[i];
                                s += '<option value="' + ri.id + '">' + ri.nameru + '</option>';
                            }
                        }
                        return s + "</select>";
                    }
                }
            }
        ],
        cmTemplate: {sortable: false},
        rowNum: 5,
        rowList: [5, 10, 20, 30],
        caption: "Архив заявок",
        autowidth: true,
        shrinkToFit: true,
        height: '20%',
        minHeight: 100,
        pager: '#prequestlist_n',
        sortname: 'id',
        multiselect: false,
        viewrecords: true,
        sortorder: "desc",
        onSelectRow: function () {
            var ids = $("#requestlist_n").jqGrid('getGridParam', 'selrow');
            if (ids != null) {
                $("#requestlist").jqGrid('setGridParam', {url: 'getrequest?isarch=1&id=' + ids, page: 1});
                $("#requestlist").jqGrid('setCaption', "Деталицация заявки №: " + ids)
                    .trigger('reloadGrid');
                $("#requestlist_d").jqGrid('setGridParam', {url: 'getrequestdesc?isarch=1&id=' + ids, page: 1});
                $("#requestlist_d").jqGrid('setCaption', "Дополнительная информация по заявке №: " + ids)
                    .trigger('reloadGrid');
            } else {
                ids = 0;
                if ($("#requestlist").jqGrid('getGridParam', 'records') > 0) {
                    $("#requestlist").jqGrid('setGridParam', {url: 'getrequest?isarch=1&id=' + ids, page: 1});
                    $("#requestlist").jqGrid('setCaption', "Деталицация заявки №: " + ids).trigger('reloadGrid');
                }
                if ($("#requestlist_d").jqGrid('getGridParam', 'records') > 0) {
                    $("#requestlist_d").jqGrid('setGridParam', {url: 'getrequestdesc?isarch=1&id=' + ids, page: 1 });
                    $("#requestlist_d").jqGrid('setCaption', "Дополнительная информация по заявке №: " + ids)
                        .trigger('reloadGrid');
                }
            }
        }
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
            {name: 'name', index: 'name' , sortable: false, width: '40%'},
            {name: 'value', index: 'value' , sortable: false, width: '60%'},
            {name: 'idreq', index: 'idreq', hidden: true }
        ],
        rowNum: 15,
        cmTemplate: {sortable: false},
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
    $("#requestlist").jqGrid('navGrid', "#prequestlist", {edit: false, add: false, del: false, search: false});
    $("#requestlist_d").jqGrid({
        regional: 'ru',
        url: 'getrequestdesc?isarch&id=0',
        datatype: "json",
        colNames: ['Id', 'П/н №', 'К-во мест и вид упак.', 'Описание товара', 'Критерий', 'Кол-во товара', 'Ед.изм.', 'Номер и дата счета-фактуры'],
        colModel: [{name: 'id', index: 'id', hidden: true, width: '2%'},
            {name: 'paragraph', index: 'paragraph', width: '5%' },
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
        multiselect: false,
        caption: "Дополнительная информация по заявке"
    });
    $("#requestlist_d").jqGrid('navGrid', '#prequestlist_d', {add: false, edit: true, del: false, search: false});
});