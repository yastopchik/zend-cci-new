$(function () {
    $("#orgexecutor").jqGrid({
        regional: 'ru',
        url: "dmnexecutor/getorgexecutor",
        datatype: "json",
        colNames: ['ID', 'Название', 'ПолноеНазвание', 'ПолноеНазваниеАнглиск', 'Город', 'Адрес', 'АдресАнглиск', 'Телефон', 'УНП'],
        colModel: [{name: 'id', index: 'id', width: '2%', search: false},
            {
                name: 'name',
                index: 'name',
                width: '11%',
                editable: true,
                editrules: {required: true}
            },
            {
                name: 'fullname',
                index: 'fullname',
                width: '15%',
                editable: true,
                editrules: {required: true}
            },
            {
                name: 'fullnameen',
                index: 'fullnameen',
                width: '15%',
                editable: true,
                editrules: {required: true}
            },
            {
                name: 'city', index: 'city', width: '8%', editable: true, edittype: 'select',
                editoptions: {
                    dataUrl: 'dmnexecutor/getcity',
                    style: "width:98%",
                    buildSelect: function (data) {
                        var response = $.parseJSON(data);
                        var s = '<select>';
                        if (response && response.length) {
                            for (var i = 0, l = response.length; i < l; i++) {
                                var ri = response[i];
                                s += '<option value="' + ri.id + '">' + ri.city + '</option>';
                            }
                        }
                        return s + "</select>";
                    }
                },
            },
            {
                name: 'address',
                index: 'address',
                width: '18%',
                editable: true,
                edittype: 'textarea',
                editoptions: {rows: "3", cols: "30"},
                editrules: {required: true}
            },
            {
                name: 'addressen',
                index: 'addressen',
                width: '18%',
                editable: true,
                edittype: 'textarea',
                editoptions: {rows: "3", cols: "30"},
                editrules: {required: true}
            },
            {
                name: 'phone',
                index: 'phone',
                width: '7%',
                editable: true,
                editrules: {required: true}
            },
            {
                name: 'unp',
                index: 'unp',
                width: '6%',
                editable: true,
                editrules: {required: true, integer: true}
            }
        ],
        rowNum: 10,
        rowList: [5, 10, 20, 30],
        autowidth: true,
        shrinkToFit: true,
        height: '20%',
        pager: '#porgexecutor',
        multiselect: false,
        viewrecords: true,
        sortorder: "desc",
        editurl: "dmnexecutor/editorgexecutor",
        caption: "Представительства (филиалы) Торгово-Промышленной Палаты",
        onSelectRow: function () {
            var ids = $("#orgexecutor").jqGrid('getGridParam', 'selrow');
            if (ids != null) {
                $("#user").jqGrid('setGridParam', {url: 'dmnexecutor/getexecutor?id=' + ids, page: 1});
                $("#user").jqGrid('setGridParam', {editurl: 'dmnexecutor/editexecutor?orgId=' + ids});
                $("#user").jqGrid('setCaption', "Сотрудники  Торгово-Промышленной Палаты ")
                    .trigger('reloadGrid');
            } else {
                ids = 0;
                if ($("#executor").jqGrid('getGridParam', 'records') > 0) {
                    $("#user").jqGrid('setGridParam', {url: 'dmnexecutor/getexecutor?id=' + ids, page: 1});
                    $("#user").jqGrid('setCaption', "Сотрудники  Торгово-Промышленной Палаты")
                        .trigger('reloadGrid');
                }
            }
        },
    });
    $("#orgexecutor").jqGrid('navGrid', "#porgexecutor", {edit: true, add: false, del: false, search: false},
        {
            width: '50%',
            reloadAfterSubmit: true,
            closeAfterEdit: true,
            beforeShowForm: function (form) {
                var dlgDiv = $("#editmodorgexecutor");
                var parentDiv = dlgDiv.parent();
                var dlgWidth = dlgDiv.width();
                var parentWidth = parentDiv.width();
                var parentLeft = parentDiv.offset().left;
                dlgDiv[0].style.left = Math.round(parentLeft + (parentWidth - dlgWidth  ) / 2) + "px";
            },
        }
    );
    $("#user").jqGrid({
        regional: 'ru',
        url: 'dmnexecutor/getexecutor?id=0',
        datatype: "json",
        colNames: ['Id', 'Логин', 'Email', 'Имя Полное', 'Имя', 'ИмяАнглиск.', 'Должность', 'Телефон', 'Активация', 'РольId', 'Роль', 'Дата'],
        colModel: [{name: 'id', index: 'id', width: '2%'},
            {
                name: 'login', index: 'login', width: '12%', editable: true, editrules: {
                required: true, custom: true,
                custom_func: function (value) {
                    return validLogin(value, 'login', 'поля Логин');
                }
            }
            },
            {
                name: 'email', index: 'email', width: '15%', editable: true, editrules: {
                required: false, email: true, custom: true,
                custom_func: function (value) {
                    return validEmail(value, 'email', 'поля Email');
                }
            }
            },
            {
                name: 'executor', index: 'executor', width: '11%', editable: true, editrules: {
                required: true, custom: true,
                custom_func: function (value) {
                    return validExecutor(value, 'executor', 'поля Имя Полное');
                }
            }
            },
            {
                name: 'nameshort',
                index: 'nameshort',
                width: '7%',
                editable: true,
                editrules: {required: true}
            },
            {
                name: 'nameshorten',
                index: 'nameshorten',
                width: '7%',
                editable: true,
                editrules: {required: true}
            },
            {
                name: 'position', index: 'position', width: '10%', editable: true, editrules: {
               required: true, custom: true,
                custom_func: function (value) {
                    return validExecutor(value, 'position', 'поля Должность');
                }
            }
            },
            {
                name: 'phone', index: 'phone', width: '9%', editable: true, editrules: {
                required: true, custom: true,
                custom_func: function (value) {
                    return validPhone(value, 'phone', 'поля Телефон');
                }
            }
            },
            {
                name: 'activate', index: 'activate', width: '7%',
                formatter: function (cellValue, options, rowObject) {
                    if (cellValue == '1') {
                        return 'Активный';
                    } else if (cellValue == '0') {
                        return 'Блокирован';
                    } else {
                        return cellValue;
                    }
                },
                unformat: function (cellvalue) {
                    switch (cellvalue) {
                        case "Активный":
                            return "1";
                        case "Блокирован":
                            return "0";
                        default:
                            return "0";
                    }
                },
                edittype: 'checkbox', editoptions: {value: "1:0"}, formatoptions: {disabled: 0}, editable: true
            },
            {name: 'roleId', index: 'roleId', width: '1%', hidden: true},
            {
                name: 'roleRus', index: 'roleRus', width: '10%', editable: true, edittype: 'select',
                editoptions: {
                    dataUrl: 'dmnexecutor/getrole',
                    style: "width:98%",
                    buildSelect: function (data) {
                        var response = $.parseJSON(data);
                        var s = '<select>';
                        if (response && response.length) {
                            for (var i = 0, l = response.length; i < l; i++) {
                                var ri = response[i];
                                s += '<option value="' + ri.id + '">' + ri.roleRus + '</option>';
                            }
                        }
                        return s + "</select>";
                    }
                },
            },
            {name: 'datelastvisit', index: 'datelastvisit', width: '10%', editable: false}
        ],
        rowNum: 15,
        autowidth: true,
        shrinkToFit: true,
        height: '100%',
        rowList: [10, 20, 30],
        pager: '#puser',
        sortname: 'item',
        viewrecords: true,
        sortorder: "asc",
        multiselect: false,
        gridComplete: function () {
            var ids = $("#orgexecutor").jqGrid('getDataIDs');
            if (ids == 0) {
                $("#gridWrapper").hide();
            }
            else {
                $('#gridWrapper').show();
            }
        },
    });
    $("#user").jqGrid('navGrid', '#puser', {add: true, edit: true, del: false, search: false},
        {
            width: 300,
            reloadAfterSubmit: true,
            closeAfterEdit: true,
            beforeShowForm: function (form) {
                var dlgDiv = $("#editmoduser");
                var parentDiv = dlgDiv.parent();
                var dlgWidth = dlgDiv.width();
                var parentWidth = parentDiv.width();
                var parentLeft = parentDiv.offset().left;
                dlgDiv[0].style.top = "100px";
                dlgDiv[0].style.left = Math.round(parentLeft + (parentWidth - dlgWidth  ) / 2) + "px";
            }
        },
        {
            closeAfterAdd: true,
            rowID: "new_row",
            position: "last",
            useDefValues: true,
            width: 300,
            reloadAfterSubmit: true,
            beforeShowForm: function (form) {
                var dlgDiv = $("#editmoduser");
                var parentDiv = dlgDiv.parent();
                var dlgWidth = dlgDiv.width();
                var parentWidth = parentDiv.width();
                var parentLeft = parentDiv.offset().left;
                dlgDiv[0].style.top = "100px";
                dlgDiv[0].style.left = Math.round(parentLeft + (parentWidth - dlgWidth  ) / 2) + "px";
            },
        });
});
function validLogin(value, colname, message) {
    var result = null;
    value.trim();
    var ids = $("#user").jqGrid('getGridParam', 'selrow');
    var myLoginEditRegEx = new RegExp("[0-9a-zA-Z]{6,20}", "i");
    if(!myLoginEditRegEx.test(value))
        return [false, "Значение " + message + " должно соответствовать регулярному выражению [0-9a-zA-Z]{6,20}"];
    $.ajax({
        async: false,
        url: 'dmnexecutor/noobjectexist',
        type: 'POST',
        data: {value: value, name: colname, id: ids, position: 2},
        success: function (res) {
            if (res === "true")
                result = [true, ""];
            else
                result = [false, "Такой пользователь уже есть в базе данных!"];
        },
        error: function () {
            Message.error('Ошибка валидации' + message);
            result = [false, "Такой пользователь уже есть в базе данных!"];
        }
    });

    return result;
}
function validEmail(value, colname, message) {
    var result = null;
    value.trim();
    var ids = $("#user").jqGrid('getGridParam', 'selrow');
    $.ajax({
        async: false,
        url: 'dmnexecutor/noobjectexist',
        type: 'POST',
        data: {value: value, name: colname, id: ids, position: 2},
        success: function (res) {
            if (res === "true")
                result = [true, ""];
            else
                result = [false, "Такой email уже есть в базе данных у другого пользователя!"];
        },
        error: function () {
            Message.error('Ошибка валидации' + message);
            result = [false, "Такой email уже есть в базе данных у другого пользователя!"];
        }
    });


    return result;
}
function validExecutor(value, colname, message) {
    var result = [true, ""];
    value.trim();
    var myLoginEditRegEx = new RegExp(/^[а-яА-ЯёЁ0-9._-\s]+/i);
    var count = 0;
    for (var i = 0; i < value.length; i++) {
        if (myLoginEditRegEx.test(value[i]))
            count++;
        else
            return [false, "Значение " + message + " должно соответствовать выражению [а-яА-Я0-9._-\s]"];
    }
    return result;
}
function validPhone(value, colname) {
    var result = [true, ""];
    value.trim();
    var myLoginEditRegEx = new RegExp("[0-9]{5,20}", "i");
    if(!myLoginEditRegEx.test(value))
        return [false, "Значение " + message + " должно соответствовать выражению [0-9]{6,20}"];
    return result;
}