$(function () {
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