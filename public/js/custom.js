var today = new Date();
$(document).ready(function(){
   var fusion = $('#fusion');
    if (fusion.length){
        $("#loadImg").show();
        getstat('dmnstatistics/fusion');
    }
});
function atoprint(aId) {
    $("#print").hide();
    var atext = document.getElementById(aId).innerHTML;
    var captext = window.document.title;
    var alink = window.document.location;
    var prwin = open('');
    prwin.document.open();
    prwin.document.writeln('<html><head><title>Версия для печати<\/title><link type="text/css" rel="stylesheet" media="screen" href="/css/print.css"><\/head><body text="#000000" bgcolor="#FFFFFF"><div onselectstart="return false;" oncopy="return false;">');
    prwin.document.writeln('<h1 style="color:#000000; fontsize:16px">' + captext + '<\/h1>');
    prwin.document.writeln(atext);
    prwin.document.writeln('<div style="font-size:8pt;">Страница материала: ' + alink + '<\/div>');
    prwin.document.writeln('<\/div><\/body><\/html>');
    $("#print").show();
}
function getStatus(block) {
    $.ajax({
        datatype: "json",
        url: "dmnrequest/getstatus",
        async: true,
        success: function (data) {
            var response = jQuery.parseJSON(data);
            var s = '<select id="statstatus" class="form-control"><option value="0">Статус</option>';
            if (response && response.length) {
                for (var i = 0, l = response.length; i < l; i++) {
                    var ri = response[i];
                    s += '<option value="' + ri.id + '">' + ri.status + '</option>';
                }
            }
            s + "</select>";
            block.append(s);
        },
        error: function (request, status, error) {
            alert(request.responseText);
        }
    });
}
function getExecuters(block) {
    $.ajax({
        datatype: "json",
        url: "dmnrequest/getexecutors",
        async: true,
        success: function (data) {
            var response = jQuery.parseJSON(data);
            var s = '<select id="statexecutors" class="form-control"><option value="0">Исполнитель</option>';
            if (response && response.length) {
                for (var i = 0, l = response.length; i < l; i++) {
                    var ri = response[i];
                    s += '<option value="' + ri.id + '">' + ri.executor + '</option>';
                }
            }
            s + "</select>";
            block.append(s);
        },
        error: function (request, status, error) {
            alert(request.responseText);
        }
    });
}
function getCountries(block) {
    $.ajax({
        datatype: "json",
        url: "dmnrequest/geteditcountries",
        async: true,
        success: function (data) {
            var response = jQuery.parseJSON(data);
            var s = '<select id="statcountries" class="form-control"><option value="0">Страна</option>';
            if (response && response.length) {
                for (var i = 0, l = response.length; i < l; i++) {
                    var ri = response[i];
                    s += '<option value="' + ri.id + '">' + ri.nameru + '</option>';
                }
            }
            s + "</select>";
            block.append(s);
        },
        error: function (request, status, error) {
            alert(request.responseText);
        }
    });
}
function getForms(block) {
    $.ajax({
        datatype: "json",
        url: "dmnrequest/getforms",
        async: true,
        success: function (data) {
            var response = jQuery.parseJSON(data);
            var s = '<select id="statforms" class="form-control"><option value="0">Форма</option>';
            if (response && response.length) {
                for (var i = 0, l = response.length; i < l; i++) {
                    var ri = response[i];
                    s += '<option value="' + ri.id + '">' + ri.forms + '</option>';
                }
            }
            s + "</select>";
            block.append(s);
        },
        error: function (request, status, error) {
            alert(request.responseText);
        }
    });
}
function getOrganization(block) {
    $.ajax({
        datatype: "json",
        url: "dmnrequest/getexorganization?id=1",
        async: true,
        success: function (data) {
            var response = jQuery.parseJSON(data);
            var s = '<select id="statorganization" class="form-control"><option value="0">Организация</option>';
            if (response && response.length) {
                for (var i = 0, l = response.length; i < l; i++) {
                    var ri = response[i];
                    s += '<option value="' + ri.id + '">' + ri.name + '</option>';
                }
            }
            s + "</select>";
            block.append(s);
        },
        error: function (request, status, error) {
            alert(request.responseText);
        }
    });
}
function getstat(href, period, periodview) {
    var urls = href;
    var imgStat=$('#imgStat');
    if(imgStat.length){
        imgStat.remove();
    }
    var selectdate = '-' + dateFormat(today, "d, mmmm, yyyy");
    if (typeof(period) != "undefined") {
        if (periodview) selectdate = periodview;
        var questions = "";
        $.each(period, function (i, val) {
            questions += i + '=' + val.trim() + '&';
        });
        urls += '?' + questions;
    }
    $("#fusion").append(
        '<div id="imgStat">' +
        '<h1><span>Выбран период: </span><a href="#" data-href="' + href + '" id="selectdate" title="Выбран период' + selectdate + '">' + selectdate + ' <i class="fa fa-calendar fa-2x"></i></a>  ' +
        '<a href="dmnstatistics/xls?' + questions + '" title="Выгрузить в xls"><i class="fa fa-file-excel-o fa-2x"></i></a>  <a href="javascript://" title="Печать" onclick="atoprint(\'imgStat\')"><i class="fa fa-print fa-2x"></i></a></h1>' +
        '<div id="chartContainerClients" class="chartContainer"></div><div id="chartContainerForms" class="chartContainer"></div>' +
        '<div id="chartContainerExecutors" class="chartContainer"></div><div id="chartContainerStatus" class="chartContainer"></div><div id="chartContainerCountry" class="chartContainer"></div>' +
        '<div id="chartFilter" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" >' +
        '<div class="modal-dialog modal-sm"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
        '<h4 class="modal-title">Выбирете необходимые параметры</h4></div><div class="modal-body"></div>'+
        '<div class="modal-footer"></div></div></div></div></div>');
    var caption = {
        'chartContainerClients': 'Отчет по клиентам',
        'chartContainerForms': 'Отчет по формам',
        'chartContainerExecutors': 'Отчет по исполнителям',
        'chartContainerStatus': 'Отчет по статусам',
        'chartContainerCountry': 'Отчет по странам',
    };
    $.ajax({
        dataType: "json",
        url: urls,
        success: function (json) {
            $("#loadImg").hide();
            $.each(json, function (chart, val) {
                var revenueChart = new FusionCharts({
                    "type": "pie3d",
                    "renderAt": chart,
                    "showpercentvalues": "1",
                    "height": "300",
                    "width": "100%",
                    "dataFormat": "json",
                    "dataSource": {
                        "chart": {
                            "theme": "fint",
                            "formatnumberscale": "0",
                            "caption": caption[chart],
                        },
                        "data": val['data']
                    }
                });
                revenueChart.render();
            });
        },
        error: function (request, status, error) {
            alert(request.responseText);
        }
    });
};
$(document).delegate("#helpHref", "click", function(){
    var modalHelp = $("#modalHelp");
    var href=$("helpHref").data("href");
    if(modalHelp.length){
        modalHelp.modal();
        var modalBody=modalFilter.find('.modal-body');
        if(modalBody.length)
        {
            modalBody.load(href);
        }
    }
});
$(document).delegate("a#tab2", "click", function () {
    $("a#tab1").removeClass("active");
    $(this).attr("class", "active");
    getstat($(this).attr("href"));
    return false;
});
$(document).delegate('a#selectdate', 'click', function () {
    //calendar.show();
    var modalFilter = $("#chartFilter");
    if (modalFilter.length) {
        modalFilter.modal();
        var modalBody=modalFilter.find('.modal-body');
        if(modalBody.length) {
            modalBody.empty();
            modalBody.attr('class', 'modal-body');
            modalBody.multiDatesPicker({
                changeMonth: true,
                changeYear: true,
                "autoclose": true,
                monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
                    'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
                monthNamesShort: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн',
                    'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],
                dayNames: ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'],
                dayNamesShort: ['вск', 'пнд', 'втр', 'срд', 'чтв', 'птн', 'сбт'],
                dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
                maxPicks: 2,
                addDates: [today],
                dateFormat: 'yy-mm-dd'
            });
            getStatus(modalBody);
            getExecuters(modalBody);
            getForms(modalBody);
            getOrganization(modalBody);
            getCountries(modalBody);
            var modalFooter= modalFilter.find('.modal-footer');
            if(modalFooter.length){
                modalFooter.empty();
                modalFooter.append('<button type="button" class="btn btn-default"  data-dismiss="modal">Закрыть</button><button type="button" id="show_dates" class="btn btn-primary" data-href="' + $(this).data("href") + '">Показать</button>');
            }
        }
     }
});
$(document).delegate('#show_dates', 'click', function (e) {
    e.preventDefault();
    var modalFilter = $("#chartFilter");
    if (modalFilter.length) {
        var modalBody=modalFilter.find('.modal-body');
        if(modalBody.length) {
            var href = $(this).data("href");
            var dates = modalBody.multiDatesPicker('getDates');
            var period = '';
            var periodview = '';
            for (d in dates) {
                period += dates[d] + ' ';
                periodview += '-' + dateFormat(dates[d], "d, mmmm, yyyy");
            }
            $("#loadImg").show();
            getstat(href, {
                'period': period,
                'executors': $("#statexecutors option:selected").val(),
                'organization': $("#statorganization option:selected").val(),
                'forms': $("#statforms option:selected").val(),
                'status': $("#statstatus option:selected").val(),
                'country': $("#statcountries option:selected").val()
            }, periodview);
        }
        $( '.modal' ).remove();
        $( '.modal-backdrop' ).remove();
        $( 'body' ).removeClass( "modal-open" );
    }
});
$(document).on('submit', '#loginForm', function(e) {
    $.ajax({
        type: 'POST',
        cache    : false,
        url: $(this).attr("action"),
        data: $(this).serialize(),
        success: function(response) {
            var rpcResponse = JSON.parse(response);
			$("#loadImg").hide();
            if (typeof(rpcResponse.error) != 'undefined') {
                Message.error(rpcResponse.error.message);
            } else {
                Message.success('Вы успешно авторизированы');
                if (typeof(rpcResponse.route) != 'undefined'){
                    window.location.href = rpcResponse.route;
                }
                location.reload();
            }

        },
        error: function(response) {
            Message.error(response);
        }
    });
	$("#loadImg").show();
    e.preventDefault();
    return false;
});
$(document).delegate('#close_dates', 'click', function () {
    $("#calendar").hide();
});
/*Messages*/
Message = {
    success: function(message) {
        if (message) {
            $.jGrowl(message, {theme: 'message-success'});
        }
    }
    ,error: function(message) {
        if (message) {
            $.jGrowl(message, {theme: 'message-error'});
        }
    }
    ,info: function(message) {
        if (message) {
            $.jGrowl(message, {theme: 'message-info'});
        }
    }
    ,close: function() {
        $.jGrowl('close');
    }
};
/*
 * Date Format 1.2.3
 * (c) 2007-2009 Steven Levithan <stevenlevithan.com>
 * MIT license
 *
 * Includes enhancements by Scott Trenda <scott.trenda.net>
 * and Kris Kowal <cixar.com/~kris.kowal/>
 *
 * Accepts a date, a mask, or a date and a mask.
 * Returns a formatted version of the given date.
 * The date defaults to the current date/time.
 * The mask defaults to dateFormat.masks.default.
 */

var dateFormat = function () {
    var token = /d{1,4}|m{1,4}|yy(?:yy)?|([HhMsTt])\1?|[LloSZ]|"[^"]*"|'[^']*'/g,
        timezone = /\b(?:[PMCEA][SDP]T|(?:Pacific|Mountain|Central|Eastern|Atlantic) (?:Standard|Daylight|Prevailing) Time|(?:GMT|UTC)(?:[-+]\d{4})?)\b/g,
        timezoneClip = /[^-+\dA-Z]/g,
        pad = function (val, len) {
            val = String(val);
            len = len || 2;
            while (val.length < len) val = "0" + val;
            return val;
        };

    // Regexes and supporting functions are cached through closure
    return function (date, mask, utc) {
        var dF = dateFormat;

        // You can't provide utc if you skip other args (use the "UTC:" mask prefix)
        if (arguments.length == 1 && Object.prototype.toString.call(date) == "[object String]" && !/\d/.test(date)) {
            mask = date;
            date = undefined;
        }

        // Passing date through Date applies Date.parse, if necessary
        date = date ? new Date(date) : new Date;
        if (isNaN(date)) throw SyntaxError("invalid date");

        mask = String(dF.masks[mask] || mask || dF.masks["default"]);

        // Allow setting the utc argument via the mask
        if (mask.slice(0, 4) == "UTC:") {
            mask = mask.slice(4);
            utc = true;
        }

        var _ = utc ? "getUTC" : "get",
            d = date[_ + "Date"](),
            D = date[_ + "Day"](),
            m = date[_ + "Month"](),
            y = date[_ + "FullYear"](),
            H = date[_ + "Hours"](),
            M = date[_ + "Minutes"](),
            s = date[_ + "Seconds"](),
            L = date[_ + "Milliseconds"](),
            o = utc ? 0 : date.getTimezoneOffset(),
            flags = {
                d: d,
                dd: pad(d),
                ddd: dF.i18n.dayNames[D],
                dddd: dF.i18n.dayNames[D + 7],
                m: m + 1,
                mm: pad(m + 1),
                mmm: dF.i18n.monthNames[m],
                mmmm: dF.i18n.monthNames[m + 12],
                yy: String(y).slice(2),
                yyyy: y,
                h: H % 12 || 12,
                hh: pad(H % 12 || 12),
                H: H,
                HH: pad(H),
                M: M,
                MM: pad(M),
                s: s,
                ss: pad(s),
                l: pad(L, 3),
                L: pad(L > 99 ? Math.round(L / 10) : L),
                t: H < 12 ? "a" : "p",
                tt: H < 12 ? "am" : "pm",
                T: H < 12 ? "A" : "P",
                TT: H < 12 ? "AM" : "PM",
                Z: utc ? "UTC" : (String(date).match(timezone) || [""]).pop().replace(timezoneClip, ""),
                o: (o > 0 ? "-" : "+") + pad(Math.floor(Math.abs(o) / 60) * 100 + Math.abs(o) % 60, 4),
                S: ["th", "st", "nd", "rd"][d % 10 > 3 ? 0 : (d % 100 - d % 10 != 10) * d % 10]
            };

        return mask.replace(token, function ($0) {
            return $0 in flags ? flags[$0] : $0.slice(1, $0.length - 1);
        });
    };
}();

// Some common format strings
dateFormat.masks = {
    "default": "ddd mmm dd yyyy HH:MM:ss",
    shortDate: "m/d/yy",
    mediumDate: "mmm d, yyyy",
    longDate: "mmmm d, yyyy",
    fullDate: "dddd, mmmm d, yyyy",
    shortTime: "h:MM TT",
    mediumTime: "h:MM:ss TT",
    longTime: "h:MM:ss TT Z",
    isoDate: "yyyy-mm-dd",
    isoTime: "HH:MM:ss",
    isoDateTime: "yyyy-mm-dd'T'HH:MM:ss",
    isoUtcDateTime: "UTC:yyyy-mm-dd'T'HH:MM:ss'Z'"
};

// Internationalization strings - русская версия
dateFormat.i18n = {
    dayNames: [
        "Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб",
        "Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"
    ],
    monthNames: [
        "Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек",
        "Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"
    ]
};

// For convenience...
Date.prototype.format = function (mask, utc) {
    return dateFormat(this, mask, utc);
};
