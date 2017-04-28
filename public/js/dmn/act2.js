$(function () {
    var dayNamesMin = ["Пн", "Вт", "Ср", "Чт", "Пт", "Сб", "Вс"],
        monthNamesShort = ["Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек"];
    $("#actlist").jqGrid({
        regional: 'ru',
        url: "acts/getactnumbers",
        datatype: "json",
        colNames: ['№ Акта', 'Страна ', 'Дата акта', 'Срок действия', 'Статус'],
        colModel: [            
            {name: 'numact', index: 'numact', width: '10%', editable: false, searchoptions: {sopt: ['eq']}},
            {name: 'countryrule', index: 'countryrule', width: '10%', editable: true, searchoptions: {sopt: ['eq']}},
            {
                name: 'dateact', index: 'dateact', width: '10%', editable: false, 
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
                name: 'dateduration', index: 'dateduration', width: '10%', editable: false, 
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
                editable: false,
                stype: 'select',               
                searchoptions: {
                    sopt: ['eq'],
                    dataUrl: 'acts/getstatus',
                    style: "width:95%",
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
        ],
        cmTemplate: {sortable: false},
        rowNum: 10,
        rowList: [5, 10, 20, 30],
        autowidth: true,
        shrinkToFit: true,
        height: '20%',
        minHeight: 100,
        caption: "Акты экспертизы",
        pager: '#pactlist',
        sortname: 'id',
        multiselect: false,
        viewrecords: true,
        sortorder: "desc",
        onSelectRow: function () {
            var ids = $("#actlist").jqGrid('getGridParam', 'selrow');
            if (ids != null) {
                $("#gridWrapper").show();
                $("#acts_d").jqGrid('setGridParam', {url: 'acts/getacts?id=' + ids, page: 1});
                $("#acts_d").jqGrid('setCaption', "Дополнительная информация по акту экспертизы").trigger('reloadGrid');
            } else {
                $("#gridWrapper").hide();
            }
        },
    });
    $("#actlist").jqGrid('navGrid', "#pactlist", {edit: false, add: false, del: false, search: true},
        {},
        {},
        {},
        {
            closeOnEscape: true,
            multipleSearch: true,
            closeAfterSearch: true,
        }
    );
    $("#acts_d").jqGrid({
        regional: 'ru',
        url: 'acts/getacts?id=0',
        datatype: "json",
        colNames: ['Код ТН ВЭД', 'Наименование товара', 'Критерий происхожденя'],
        colModel: [
            {
                name: 'hscode',
                index: 'hscode',
                width: '30%',
                editable: false,
                editoptions: {rows: "5", cols: "60"}
            },
            {
                name: 'description',
                index: 'description',
                width: '30%',
                editable: false,
                editoptions: {rows: "5", cols: "60"}
            },
            {
                name: 'criorigin',
                index: 'criorigin',
                width: '30%',
                editable: false,
                editoptions: {rows: "5", cols: "60"}
            },
        ],
        cmTemplate: {sortable: false},
        rowNum: 15,
        autowidth: true,
        shrinkToFit: true,
        height: '100%',
        rowList: [10, 20, 30],
        pager: '#pacts_d',
        sortname: 'item',
        viewrecords: true,
        sortorder: "asc",
        multiselect: false,
        caption: "Дополнительная информация по актам экспертизы",
        gridComplete: function () {
            var ids =$("#actlist").jqGrid ('getGridParam', 'selrow'),
                idsd = $("#acts_d").jqGrid('getDataIDs');
            if (ids===null && idsd.length == 0) {
                $("#gridWrapper").hide();
            }
            else {
                $('#gridWrapper').show();
            }
        },
    });
    $("#acts_d").jqGrid('navGrid', '#pacts_d', {add: false, edit: false, del: false, search: false},
        {},
        {}
    );
});

