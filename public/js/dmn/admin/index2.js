$(function () {
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
});