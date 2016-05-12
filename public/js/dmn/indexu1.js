$(function () {
    $(function () {
        $("#orguser").jqGrid({
            regional: 'ru',
            url: "dmnuser/getorguser",
            datatype: "json",
            colNames: ['ID', 'Название', 'ПолноеНазвание', 'Город', 'Адрес', 'Телефон', 'УНП', 'НомерДоговора', 'ДатаДоговора', 'СЭЗ'],
            colModel: [{name: 'id', index: 'id', width: '2%', search: false},
                {
                    name: 'name',
                    index: 'name',
                    width: '14%',
                    editable: true,
                    searchoptions: {sopt: ['eq']},
                    editrules: {required: true, custom: true,
                        custom_func: function (value) {
                            return validOrg(value, 'name');
                        }
                    }
                },
                {
                    name: 'fullname',
                    index: 'fullname',
                    width: '15%',
                    editable: true,
                    search: false,
                    editrules: {required: true}
                },
                {
                    name: 'city', index: 'city', width: '6%', editable: true, edittype: 'select', search: false,
                    editoptions: {
                        dataUrl: 'dmnexecutor/getcity',
                        style: "width:98%",
                        buildSelect: function (data) {
                            var response = jQuery.parseJSON(data);
                            var s = '<select>';
                            if (response && response.length) {
                                for (var i = 0, l = response.length; i < l; i++) {
                                    var ri = response[i];
                                    s += '<option value="' + ri.id + '">' + ri.city + '</option>';
                                }
                            }
                            return s + "</select>";
                        },
                    },
                },
                {
                    name: 'address',
                    index: 'address',
                    width: '26%',
                    editable: true,
                    search: false,
                    edittype: 'textarea',
                    editoptions: {rows: "3", cols: "42"},
                    editrules: {required: true}
                },
                {
                    name: 'phone',
                    index: 'phone',
                    width: '8%',
                    editable: true,
                    search: false,
                    editrules: {required: true}
                },
                {
                    name: 'unp', index: 'unp', width: '6%', editable: true, searchoptions: {sopt: ['eq']}, editrules: {
                    minValue: 9, maxValue: 9, integer: true, required: true, custom: true,
                    custom_func: function (value) {
                        return validOrg(value, 'unp');
                    }
                }
                },
                {name: 'contract', index: 'contract', width: '8%', editable: true, searchoptions: {sopt: ['eq']}},
                {
                    name: 'datecontract', index: 'datecontract', width: '6%', editable: true,
                    editoptions: {
                        required: false, dataInit: function (el) {
                            setTimeout(function () {
                                $(el).datepicker({dateFormat: "dd/mm/yy"});
                            }, 200);
                        }
                    },
                    searchoptions: {
                        sopt: ['eq'], dataInit: function (el) {
                            setTimeout(function () {
                                $(el).datepicker({dateFormat: "dd/mm/yy"});
                            }, 200);
                        }
                    }
                },
                {
                    name: 'sezname', index: 'sezname', width: '9%', editable: true, edittype: 'select', search: false,
                    editoptions: {
                        dataUrl: 'dmnuser/getsez',
                        style: "width:98%",
                        buildSelect: function (data) {
                            var response = jQuery.parseJSON(data);
                            var s = '<select>';
                            if (response && response.length) {
                                for (var i = 0, l = response.length; i < l; i++) {
                                    var ri = response[i];
                                    s += '<option value="' + ri.id + '">' + ri.sezname + '</option>';
                                }
                            }
                            return s + "</select>";
                        }
                    },
                },
            ],
            rowNum: 5,
            rowList: [5, 10, 20, 30],
            autowidth: true,
            shrinkToFit: true,
            height: '20%',
            pager: '#porguser',
            multiselect: false,
            viewrecords: true,
            sortorder: "desc",
            editurl: "dmnuser/editorguser",
            caption: "Клиенты Торгово-Промышленной Палаты",
            onSelectRow: function () {
                var ids = jQuery("#orguser").jqGrid('getGridParam', 'selrow');
                if (ids != null) {
                    jQuery("#user").jqGrid('setGridParam', {url: 'dmnuser/getuser?id=' + ids, page: 1});
                    jQuery("#user").jqGrid('setGridParam', {editurl: 'dmnuser/edituser?orgId=' + ids});
                    jQuery("#user").jqGrid('setCaption', "Клиенты Торгово-Промышленной Палаты ")
                        .trigger('reloadGrid');
                } else {
                    ids = 0;
                    if ($("#user").jqGrid('getGridParam', 'records') > 0) {
                        jQuery("#user").jqGrid('setGridParam', {url: 'dmnuser/getuser?id=' + ids, page: 1});
                        jQuery("#user").jqGrid('setCaption', "Клиенты  Торгово-Промышленной Палаты")
                            .trigger('reloadGrid');
                    }
                }
            },
        });
        $("#orguser").jqGrid('navGrid', "#porguser", {edit: true, add: true, del: false, search: true},
            {
                width: '70%',
                reloadAfterSubmit: true,
                closeAfterEdit: true,
                beforeShowForm: function (form) {
                    var dlgDiv = $("#editmodorguser");
                    var parentDiv = dlgDiv.parent();
                    var dlgWidth = dlgDiv.width();
                    var parentWidth = parentDiv.width();
                    var parentLeft = parentDiv.offset().left;
                    dlgDiv[0].style.left = Math.round(parentLeft + (parentWidth - dlgWidth  ) / 2) + "px";
                }
            },
            {
                closeAfterAdd: true,
                rowID: "new_row",
                position: "last",
                useDefValues: true,
                width: '70%',
                reloadAfterSubmit: true,
                beforeShowForm: function (form) {
                    var dlgDiv = $("#editmodorguser");
                    var parentDiv = dlgDiv.parent();
                    var dlgWidth = dlgDiv.width();
                    var parentWidth = parentDiv.width();
                    var parentLeft = parentDiv.offset().left;
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
        $("#user").jqGrid({
            regional: 'ru',
            url: 'dmnuser/getuser?id=0',
            datatype: "json",
            colNames: ['Id', 'Логин', 'Email', 'Имя Полное', 'Имя', 'Должность', 'Телефон', 'Активация', 'Дата'],
            colModel: [{name: 'id', index: 'id', width: '2%'},
                {
                    name: 'login', index: 'login', width: '12%', editable: true, editrules: {
                    required: true, custom: true,
                    custom_func: function (value) {
                        return validLogin(value, 'login');
                    }
                }
                },
                {
                    name: 'email', index: 'email', width: '15%', editable: true, editrules: {
                    required: false, email: true,
                    custom_func: function (value) {
                        return validEmail(value, 'email');
                    }
                }
                },
                {
                    name: 'executor', index: 'executor', width: '13%', editable: true, editrules: {
                   required: true, custom: true,
                    custom_func: function (value) {
                        return validExecutor(value, 'position');
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
                    name: 'position', index: 'position', width: '15%', editable: true, editrules: {
                    required: true, custom: true,
                    custom_func: function (value) {
                        return validExecutor(value, 'position');
                    }
                }
                },
                {
                    name: 'phone', index: 'phone', width: '9%', editable: true, editrules: {
                   required: true, custom: true,
                    custom_func: function (value) {
                        return validPhone(value, 'phone');
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
                var ids = jQuery("#orguser").jqGrid('getDataIDs');
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
    function validOrg(value, colname) {
        var result = null;
        value.trim();
        var ids = jQuery("#orguser").jqGrid('getGridParam', 'selrow');
        $.ajax({
            async: false,
            url: 'dmnuser/noobjectexist',
            type: 'POST',
            data: {value: value, name: colname, id: ids, position: '1'},
            success: function (res) {
                if (res === "true")
                    result = [true, ""];
                else
                    result = [false, "Такая организация ил УНП уже присутствует!"];
            },
            error: function () {
                Message.error('Ошибка валидации' + value);
            }
        });
        return result;
    }

    function validLogin(value, colname) {
        var result = null;
        value.trim();
        var ids = jQuery("#user").jqGrid('getGridParam', 'selrow');
        var myLoginEditRegEx = new RegExp("[0-9a-zA-Z]{6,20}", "i");
        if(!myLoginEditRegEx.test(value))
            return [false, "Значение " + colname + " должно соответствовать регулярному выражению [0-9a-zA-Z]{6,20}"];
        $.ajax({
            async: false,
            url: 'dmnuser/noobjectexist',
            type: 'POST',
            data: {value: value, name: colname, id: ids, position: '2'},
            success: function (res) {
                if (res === "true")
                    result = [true, ""];
                else
                    result = [false, "Такой пользователь или email уже присутствует!"];
            },
            error: function () {
                Message.error('Ошибка валидации' + value);
            }
        });
        return result;
    }

    function validEmail(value, colname) {
        var result = null;
        var ids = jQuery("#user").jqGrid('getGridParam', 'selrow');
        value.trim();
        $.ajax({
            async: false,
            url: 'dmnuser/noobjectexist',
            type: 'POST',
            data: {value: value, name: colname, id: ids, position: '2'},
            success: function (res) {
                if (res === "true")
                    result = [true, ""];
                else
                    result = [false, "Такой пользователь или email уже присутствует!"];
            },
            error: function () {
                Message.error('Ошибка валидации' + value);
            }
        });
        return result;
    }

    function validExecutor(value, colname) {
        var result = [true, ""];
        value.trim();
        var myLoginEditRegEx = new RegExp(/^[а-яА-ЯёЁ0-9._-\s]+/i);
        var count = 0;
        for (var i = 0; i < value.length; i++) {
            if (myLoginEditRegEx.test(value[i]))
                count++;
            else
                return [false, "Значение " + colname + " должно соответствовать регулярному выражению [а-яА-Я0-9._-\s]"];
        }
        return result;
    }

    function validPhone(value, colname) {
        var result = [true, ""];
        value.trim();
        var myLoginEditRegEx = new RegExp("[0-9]{5,20}", "i");
        if(!myLoginEditRegEx.test(value))
            return [false, "Значение " + colname + " должно соответствовать выражению [0-9]{6,20}"];
        return result;
    }
});