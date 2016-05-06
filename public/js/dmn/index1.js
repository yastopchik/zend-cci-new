$(function () {
    var lastSel, country;
    $.getJSON("dmnrequest/getcountryjson", function (data) {
        country = data;
    });
    $("#requestlist_n").jqGrid({
        regional: 'ru',
        url: "dmnrequest/getrequestnumber",
        datatype: "json",
        colNames: ['ID', '№Сертиф.', 'Дата', '№Бланка', 'Форма', 'Файл', 'Статус', 'КолДопЛист', 'Клиент', 'Должность', 'Телефон', 'Организация', 'Исполнитель', 'СтранаНазн', 'Действия'],
        colModel: [{name: 'id', index: 'id', width: '3%', searchoptions: {sopt: ['eq']}},
            {name: 'workorder', index: 'workorder', width: '8%', editable: true, searchoptions: {sopt: ['eq']}},
            {
                name: 'dateorder', index: 'dateorder', width: '6%', editable: true, editrules: {required: true},
                editoptions: {
                    dataInit: function (elem) {
                        $(elem).datepicker({
                            dateFormat: "dd/mm/yy",
                            dayNamesMin: ["Пн", "Вт", "Ср", "Чт", "Пт", "Сб", "Вс"],
                            monthNamesShort: ["Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек"],
                            changeYear: true,
                            changeMonth: true,
                            onSelect: function () {
                                if (this.id.substr(0, 3) === "gs_") {
                                    // in case of searching toolbar
                                    setTimeout(function () {
                                        myGrid[0].triggerToolbar();
                                    }, 50);
                                } else {
                                    // refresh the filter in case of
                                    // searching dialog
                                    $(this).trigger('change');
                                }
                            }
                        });
                    }
                },
                searchoptions: {
                    sopt: ['eq'],
                    dataInit: function (el) {
                        setTimeout(function () {
                            $(el).datepicker({dateFormat: "dd/mm/yy"});
                        }, 200);
                    }
                }
            },
            {name: 'numblank', index: 'numblank', width: '6%', editable: true, searchoptions: {sopt: ['eq']}},
            {
                name: 'forms',
                index: 'forms',
                width: '6%',
                editable: true,
                edittype: 'select',
                editrules: {required: true},
                editoptions: {
                    dataUrl: 'dmnrequest/getforms',
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
                stype: 'select',
                searchoptions: {
                    dataUrl: 'dmnrequest/getforms',
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
            {name: 'file', index: 'file', width: '6%', editable: false},
            {
                name: 'status',
                index: 'status',
                width: '6%',
                editable: true,
                edittype: 'select',
                stype: 'select',
                editrules: {required: true},
                editoptions: {
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
                searchoptions: {
                    sopt: ['eq'],
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
                }
            },
            {
                name: 'numdoplist',
                index: 'numdoplist',
                width: '5%',
                editable: true,
                search: false,
                editrules: {required: true, maxValue: '2', minValue: '1'},
            },
            {
                name: 'name',
                index: 'name',
                width: '6%',
                editable: false,
                cellattr: function (rowId, tv, rawObject, cm, rdata) {
                    return 'style="white-space: normal;"'
                }
            },
            {name: 'position', index: 'position', width: '5%', editable: false, searchoptions: {sopt: ['eq']}},
            {name: 'phone', index: 'phone', width: '5%', editable: false},
            {name: 'organization', index: 'organization', width: '15%', editable: false, searchoptions: {sopt: ['eq']}},
            {
                name: 'executor',
                index: 'executor',
                width: '9%',
                sortable: false,
                editable: true,
                edittype: 'select',
                stype: 'select',
                editrules: {required: true},
                editoptions: {
                    dataUrl: 'dmnrequest/getexecutors',
                    style: "width:98%",
                    buildSelect: function (data) {
                        var response = $.parseJSON(data);
                        var s = '<select>';
                        if (response && response.length) {
                            for (var i = 0, l = response.length; i < l; i++) {
                                var ri = response[i];
                                s += '<option value="' + ri.id + '">' + ri.executor + '</option>';
                            }
                        }
                        return s + "</select>";
                    }
                },
                searchoptions: {
                    sopt: ['eq'],
                    dataUrl: 'dmnrequest/getexecutors',
                    style: "width:98%",
                    buildSelect: function (data) {
                        var response = $.parseJSON(data);
                        var s = '<select>';
                        if (response && response.length) {
                            for (var i = 0, l = response.length; i < l; i++) {
                                var ri = response[i];
                                s += '<option value="' + ri.id + '">' + ri.executor + '</option>';
                            }
                        }
                        return s + "</select>";
                    }
                },
            },
            {
                name: 'destinationiso',
                index: 'destinationiso',
                width: '7%',
                editable: true,
                editrules: {required: true},
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
                                url: "dmnrequest/getcountrybyid?id=" + cellValue,
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
                            url: "dmnrequest/getcountrybyname?rows=" + cellValue,
                            async: false,
                            success: (function (result) {
                                var cObject = result[0];
                                value = cObject.id;
                            })
                        });
                    }
                    return value;

                },
                edittype: 'select',
                stype: 'select',
                editoptions: {
                    dataUrl: 'dmnrequest/geteditcountries',
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
                },
                searchoptions: {
                    sopt: ['eq'],
                    dataUrl: 'dmnrequest/geteditcountries',
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
            },
            {name: 'act', index: 'act', width: '7%', sortable: false, search: false}
        ],
        cmTemplate: {sortable: false},
        rowNum: 5,
        rowList: [5, 10, 20, 30],
        cellEdit: true,
        cellsubmit: "remote",
        cellurl: "dmnrequest/editrequestnumber",
        /*editurl: "dmnrequest/editrequestnumber",*/
        afterSaveCell: function (rowid, name, val, iRow, iCol) {
            if (name.localeCompare("status") == 0 && val == 4) {
                var isSentEmail = confirm("Вы изменили статус на действует. Отправить email заказчику?")
                if (isSentEmail && !isNaN(rowid)) {
                    $.ajax({
                        url: 'dmnrequest/sendmail?id=' + rowid,
                        data: ({
                            _search: true,
                            filters: JSON.stringify({
                                'groupOp': 'AND',
                                'rules': [{'field': 'id', 'op': 'eq', 'data': rowid}]
                            })
                        }),
                        async: false,
                        successes: function (data) {
                            Message.success('Письмо успешно отправлено заказчику');
                        }
                    });
                } else {
                    return false;
                }
            }
        },
        caption: "Заявки",
        autowidth: true,
        shrinkToFit: true,
        height: '20%',
        minHeight: 100,
        pager: '#prequestlist_n',
        sortname: 'id',
        multiselect: false,
        viewrecords: true,
        sortorder: "desc",
        onSelectCell: function () {
            var ids = $("#requestlist_n").jqGrid('getGridParam', 'selrow');
            if (ids != null) {
                $("#requestlist").jqGrid('setGridParam', {url: 'dmnrequest/getrequest?id=' + ids, page: 1});
                $("#requestlist").jqGrid('setCaption', "Деталицация заявки №: " + ids)
                    .trigger('reloadGrid');
                $("#requestlist_d").jqGrid('setGridParam', {url: 'dmnrequest/getrequestdesc?id=' + ids, page: 1});
                $("#requestlist_d").jqGrid('setCaption', "Дополнительная информация по заявке №: " + ids)
                    .trigger('reloadGrid');
            } else {
                ids = 0;
                if ($("#requestlist").jqGrid('getGridParam', 'records') > 0) {
                    $("#requestlist").jqGrid('setGridParam', {url: 'dmnrequest/getrequest?id=' + ids, page: 1});
                    $("#requestlist").jqGrid('setCaption', "Деталицация заявки №: " + ids)
                        .trigger('reloadGrid');
                }
                if ($("#requestlist_d").jqGrid('getGridParam', 'records') > 0) {
                    $("#requestlist_d").jqGrid('setGridParam', {url: 'dmnrequest/getrequestdesc?id=' + ids, page: 1});
                    $("#requestlist_d").jqGrid('setCaption', "Дополнительная информация по заявке №: " + ids)
                        .trigger('reloadGrid');
                }
            }
        },
        gridComplete: function () {
            var ids = $("#requestlist_n").jqGrid('getDataIDs');
            for (var i = 0; i < ids.length; i++) {
                var cl = ids[i];
                prints = '<a href="#"  class="btn btn-danger btn-sm download" data-type="text" data-href="dmnupload/downloadprint?id=' + cl + '">' +
                    '<i class="fa fa-print" title="Выгрузить для печати" aria-hidden="true"></i></a>';
                xls = '<a href="#"  class="btn btn-info btn-sm download" data-type="text" data-href="dmnupload/downloadxls?id=' + cl + '">' +
                    '<i class="fa fa-file-excel-o" title="Выгрузить в xls шаблон" aria-hidden="true"></i></a>';
                xml = '<a href="#"  class="btn btn-warning btn-sm download" data-type="xml" data-href="dmnupload/downloadxml?id=' + cl + '">' +
                    '<i class="fa fa-file-code-o" title="Выгрузить в xml" aria-hidden="true"></i></a>';
                lifecycle = '<a href="#" class="btn btn-warning btn-sm lifecycle"  data-href="dmnrequest/getlifecycle?id=' + cl + '">' +
                    '<i class="fa fa-life-ring" title="Жизненный цикл заявки" aria-hidden="true"></i></a>';
                $("#requestlist_n").jqGrid('setRowData', ids[i], {act: prints + xls + lifecycle});
            }
        }
    });
    $("#requestlist_n").jqGrid('navGrid', "#prequestlist_n", {edit: false, add: false, del: false, search: true},
        {
            jqModal: true,
            savekey: [true, 13],
            navkeys: [true, 38, 40],
            width: '50%',
            reloadAfterSubmit: true,
            closeAfterEdit: true,
            beforeShowForm: function (form) {
                var dlgDiv = $("#editmodrequestlist_n");
                var parentDiv = dlgDiv.parent();
                var dlgWidth = dlgDiv.width();
                var parentWidth = parentDiv.width();
                var dlgHeight = dlgDiv.height();
                var parentHeight = parentDiv.height();
                var parentTop = parentDiv.offset().top;
                var parentLeft = parentDiv.offset().left;
                dlgDiv[0].style.top = Math.round(parentTop + (parentHeight - dlgHeight) / 2) + "px";
                dlgDiv[0].style.left = Math.round(parentLeft + (parentWidth - dlgWidth  ) / 2) + "px";
            }
        },
        {
            jqModal: true,
            reloadAfterSubmit: true,
            closeAfterEdit: true,
            width: '50%',
            beforeShowForm: function (form) {
                var dlgDiv = $("#editmodrequestlist_n");
                var parentDiv = dlgDiv.parent();
                var dlgWidth = dlgDiv.width();
                var parentWidth = parentDiv.width();
                var dlgHeight = dlgDiv.height();
                var parentHeight = parentDiv.height();
                var parentTop = parentDiv.offset().top;
                var parentLeft = parentDiv.offset().left;
                dlgDiv[0].style.top = Math.round(parentTop + (parentHeight - dlgHeight) / 2) + "px";
                dlgDiv[0].style.left = Math.round(parentLeft + (parentWidth - dlgWidth  ) / 2) + "px";
            },
        },
        {},
        {
            closeOnEscape: true,
            multipleSearch: true,
            closeAfterSearch: true,
        }
    );
    $("#requestlist").jqGrid({
        regional: 'ru',
        url: 'dmnrequest/getrequest?id=0',
        datatype: "json",
        colNames: ['Наименование', 'Значение', 'IdReq'],
        colModel: [
            {name: 'name', index: 'name', editable: false, sortable: false, width: '40%'},
            {
                name: 'value', index: 'value', editable: true, editrules: {
                custom: true,
                custom_func: function (value) {
                    return validReq(value, $("#requestlist").jqGrid('getGridParam', 'selrow'));
                }
            },
                edittype: "text", sortable: false, width: '60%'
            },
            {
                name: 'idreq', index: 'idreq', hidden: true, editable: true, editoptions: {
                dataInit: function (element) {
                    $(element).attr("readonly", "readonly");
                }
            }
            }
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
        editurl: "dmnrequest/editrequest",
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
        {
            jqModal: true,
            savekey: [true, 13],
            navkeys: [true, 38, 40],
            width: '50%',
            reloadAfterSubmit: true,
            closeAfterEdit: true,
            beforeShowForm: function (form) {
                var dlgDiv = $("#editmodrequestlist");
                var parentDiv = dlgDiv.parent();
                var dlgWidth = dlgDiv.width();
                var parentWidth = parentDiv.width();
                var dlgHeight = dlgDiv.height();
                var parentHeight = parentDiv.height();
                var parentTop = parentDiv.offset().top;
                var parentLeft = parentDiv.offset().left;
                dlgDiv[0].style.top = Math.round(parentTop + (parentHeight - dlgHeight) / 2) + "px";
                dlgDiv[0].style.left = Math.round(parentLeft + (parentWidth - dlgWidth  ) / 2) + "px";
            }
        },
        {
            jqModal: true,
            reloadAfterSubmit: true,
            closeAfterEdit: true,
            width: '50%',
            beforeShowForm: function (form) {
                var dlgDiv = $("#editmodrequestlist");
                var parentDiv = dlgDiv.parent();
                var dlgWidth = dlgDiv.width();
                var parentWidth = parentDiv.width();
                var dlgHeight = dlgDiv.height();
                var parentHeight = parentDiv.height();
                var parentTop = parentDiv.offset().top;
                var parentLeft = parentDiv.offset().left;
                dlgDiv[0].style.top = Math.round(parentTop + (parentHeight - dlgHeight) / 2) + "px";
                dlgDiv[0].style.left = Math.round(parentLeft + (parentWidth - dlgWidth  ) / 2) + "px";
            }
        });
    $("#requestlist_d").jqGrid({
        regional: 'ru',
        url: 'dmnrequest/getrequest?id=0',
        datatype: "json",
        colNames: ['Id', 'П/н №', 'К-во мест и вид упак.', 'Описание товара', 'Критерий', 'Кол-во товара', 'Ед.изм.', 'Номер и дата счета-фактуры'],
        colModel: [{name: 'id', index: 'id', width: '2%', hidden: true},
            {name: 'paragraph', index: 'paragraph', width: '5%', editable: true},
            {
                name: 'seats',
                index: 'seats',
                width: '20%',
                editable: true,
                edittype: "textarea",
                editoptions: {rows: "2", cols: "30"}
            },
            {
                name: 'description',
                index: 'description',
                width: '32%',
                editable: true,
                edittype: "textarea",
                editoptions: {rows: "3", cols: "30"}
            },
            {
                name: 'hscode',
                index: 'hscode',
                width: '6%',
                editable: true,
                edittype: "textarea",
                editoptions: {rows: "2", cols: "30"}
            },
            {
                name: 'quantity',
                index: 'quantity',
                width: '15%',
                editable: true,
                edittype: "textarea",
                editoptions: {rows: "2", cols: "30"}
            },
            {
                name: 'unit',
                index: 'unit',
                width: '10%',
                editable: true,
                edittype: "textarea",
                editoptions: {rows: "2", cols: "30"}
            },
            {
                name: 'invoce',
                index: 'invoce',
                width: '10%',
                editable: true,
                edittype: "textarea",
                editoptions: {rows: "2", cols: "30"}
            }
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
        editurl: "dmnrequest/editrequestdesc",
        caption: "Дополнительная информация по заявке"
    });
    $("#requestlist_d").jqGrid('navGrid', '#prequestlist_d', {add: false, edit: true, del: false, search: false},
        {
            jqModal: true,
            savekey: [true, 13],
            navkeys: [true, 38, 40],
            width: '50%',
            reloadAfterSubmit: true,
            closeAfterEdit: true,
            beforeShowForm: function (form) {
                var dlgDiv = $("#editmodrequestlist_d");
                var parentDiv = dlgDiv.parent();
                var dlgWidth = dlgDiv.width();
                var parentWidth = parentDiv.width();
                var dlgHeight = dlgDiv.height();
                var parentHeight = parentDiv.height();
                var parentTop = parentDiv.offset().top;
                var parentLeft = parentDiv.offset().left;
                dlgDiv[0].style.top = Math.round(parentTop + (parentHeight - dlgHeight) / 2) + "px";
                dlgDiv[0].style.left = Math.round(parentLeft + (parentWidth - dlgWidth  ) / 2) + "px";
            }
        },
        {
            jqModal: true,
            reloadAfterSubmit: true,
            closeAfterEdit: true,
            width: '50%',
            beforeShowForm: function (form) {
                var dlgDiv = $("#editmodrequestlist_d");
                var parentDiv = dlgDiv.parent();
                var dlgWidth = dlgDiv.width();
                var parentWidth = parentDiv.width();
                var dlgHeight = dlgDiv.height();
                var parentHeight = parentDiv.height();
                var parentTop = parentDiv.offset().top;
                var parentLeft = parentDiv.offset().left;
                dlgDiv[0].style.top = Math.round(parentTop + (parentHeight - dlgHeight) / 2) + "px";
                dlgDiv[0].style.left = Math.round(parentLeft + (parentWidth - dlgWidth  ) / 2) + "px";
            }
        });
});
function validReq(value, id) {
    var req = ["0", "2", "6", "8", "11", "14"];
    var a = req.indexOf(id);
    if ((a >= 0) && (value.length == 0)) {
        return [false, "Значение не может быть пустым"];
    } else {
        return [true, ""];
    }
}