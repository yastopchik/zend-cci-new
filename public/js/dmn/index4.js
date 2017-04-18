$(function () {
    var dayNamesMin = ["Пн", "Вт", "Ср", "Чт", "Пт", "Сб", "Вс"],
        monthNamesShort = ["Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек"];
    $("#actlist").jqGrid({
        regional: 'ru',
        url: "dmnact/getacts",
        datatype: "json",
        colNames: ['ID', '№ Акта', 'Организация', 'Страна ', 'Дата акта', 'Срок действия', 'Статус' ,'Код ТН ВЭД',  'Наименование', 'Критерий'],
        colModel: [
            {name: 'id', index: 'id', width: '3%', searchoptions: {sopt: ['eq']}},
            {name: 'numact', index: 'numact', width: '10%', editable: true, searchoptions: {sopt: ['eq']}},
            {name: 'organization', index: 'organization', width: '10%', editable: false, searchoptions: {sopt: ['eq']}},
            {name: 'countryrule', index: 'countryrule', width: '10%', editable: false, searchoptions: {sopt: ['eq']}},
            {
                name: 'dateact', index: 'dateact', width: '10%', editable: true, editrules: {required: true},
                editoptions: {
                    dataInit: function (elem) {
                        $(elem).datepicker({
                            dateFormat: "dd/mm/yy",
                            dayNamesMin: dayNamesMin,
                            monthNamesShort: monthNamesShort,
                            changeYear: true,
                            changeMonth: true,
                            onSelect: function () {
                                if (this.id.substr(0, 3) === "gs_") {
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
            {
                name: 'dateduration', index: 'dateduration', width: '10%', editable: true, editrules: {required: true},
                editoptions: {
                    dataInit: function (elem) {
                        $(elem).datepicker({
                            dateFormat: "dd/mm/yy",
                            dayNamesMin: dayNamesMin,
                            monthNamesShort: monthNamesShort,
                            changeYear: true,
                            changeMonth: true,
                            onSelect: function () {
                                if (this.id.substr(0, 3) === "gs_") {
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
            {
                name: 'status',
                index: 'status',
                width: '6%',
                editable: true,
                edittype: 'select',
                stype: 'select',
                editrules: {required: true},
                editoptions: {
                    dataUrl: 'dmnact/getstatus',
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
                    dataUrl: 'dmnact/getstatus',
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
                name: 'hscode',
                index: 'hscode',
                width: '10%',
                editable: true,
                edittype: "textarea",
                editoptions: {rows: "2", cols: "30"}
            },
            {
                name: 'description',
                index: 'description',
                width: '10%',
                editable: true,
                edittype: "textarea",
                editoptions: {rows: "3", cols: "30"}
            },
            {
                name: 'criorigin',
                index: 'criorigin',
                width: '10%',
                editable: true,
                edittype: "textarea",
                editoptions: {rows: "3", cols: "30"}
            },
        ],
        cmTemplate: {sortable: false},
        rowNum: 5,
        rowList: [5, 10, 20, 30],
        cellEdit: true,
        cellsubmit: "remote",
        cellurl: "dmnact/editact",
        caption: "Акты",
        autowidth: true,
        shrinkToFit: true,
        height: '20%',
        minHeight: 100,
        pager: '#pactlist',
        sortname: 'id',
        multiselect: false,
        viewrecords: true,
        sortorder: "desc",
    });
    $("#actlist").jqGrid('navGrid', "#pactlist", {edit: true, add: true, del: false, search: true},
        {
            jqModal: true,
            savekey: [true, 13],
            navkeys: [true, 38, 40],
            width: '50%',
            reloadAfterSubmit: true,
            closeAfterEdit: true,
            beforeShowForm: function (form) {
                var dlgDiv = $("#editmodactlist");
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
                var dlgDiv = $("#editmodactlist");
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
});
