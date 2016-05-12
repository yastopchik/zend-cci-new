$(function() {
    var lastSel;
    $("#requestorg").jqGrid({
        regional : 'ru',
        url:'../dmnexrequest/getorganization?id=0',
        datatype: "json",
        colNames:['Организация', 'Представитель'],
        colModel:[
            {name:'organization',index:'organization', width:'40%', sortable:false, editable:true, edittype: 'select',
                editoptions: {dataUrl: '../dmnexrequest/getorganization?id=1',
                    buildSelect: function(data) {
                        var response = jQuery.parseJSON(data);
                        $("#uploader").show();
                        var s = '<select>';
                        if (response && response.length) {
                            for (var i = 0, l = response.length; i < l; i++) {
                                var ri = response[i];
                                s += '<option value="' + ri.id + '">' + ri.name + '</option>';
                            }
                        }
                        return s + "</select>";
                    },
                    dataEvents :[{
                        type: 'change', fn: function(e) {
                            var thisval = $(e.target).val();
                            $.ajax({
                                dataType: "html",
                                url: '../dmnexrequest/getexecutors?id='+thisval,
                                success: function(data){
                                    $("#select#1_name").attr('disable', false);
                                    var response = jQuery.parseJSON(data);
                                    var s = '<select>';
                                    if (response && response.length) {
                                        for (var i = 0, l = response.length; i < l; i++) {
                                            var ri = response[i];
                                            s += '<option value="' + ri.id + '">' + ri.executor + '</option>';
                                        }
                                    }
                                    var res=s + "</select>";
                                    $("select#1_executor").html(res);
                                },
                            });
                        }
                    }]
                }},
            {name:'executor',index:'executor', width:'60%', sortable:false, editable:true,   edittype:'select',
                editoptions: {dataUrl: '../dmnexrequest/getexecutors?id=11',
                    buildSelect: function(data) {
                        var response = jQuery.parseJSON(data);
                        $("#uploader").show();
                        var s = '<select>';
                        if (response && response.length) {
                            for (var i = 0, l = response.length; i < l; i++) {
                                var ri = response[i];
                                s += '<option value="' + ri.id + '">' + ri.executor + '</option>';
                            }
                        }
                        return s + "</select>";
                    }}
            },
        ],
        cmTemplate:{sortable:false},
        rowNum:15,
        sortname: 'item',
        autowidth: true,
        shrinkToFit: true,
        height: '100%',
        viewrecords: true,
        onSelectRow: function(id){
            if(id && id!==lastSel){
                jQuery('#requestorg').jqGrid('restoreRow',lastSel);
                lastSel=id;
            }
            jQuery('#requestorg').jqGrid('editRow',id,true);
        },
        multiselect: false,
        caption: "Выбор организации",
        gridComplete: function() {
            $("#uploader").hide();
        }
    });
    $("#uploader").plupload({
        // General settings
        runtimes : 'html5,flash,silverlight,html4',
        url : 'http://mogbeltpp/dmnexrequest/upload',
        // Maximum file size
        max_file_size : '15mb',
        max_file_count: 10,
        multi_selection:true,
        chunk_size: '1mb',
        resize : {
            width : 200,
            height : 200,
            quality : 90,
            crop: true // crop to exact dimensions
        },
        filters : [
            {title : "Excel files", extensions : "xls,xlsx"}
        ],
        // Sort files
        sortable: false,
        dragdrop: false,
        // Views to activate
        views: {
            list: true,
            thumbs: true, // Show thumbs
            active: 'thumbs'
        },
    });

    var uploader = $("#uploader").plupload('getUploader');
    uploader.bind('BeforeUpload', function(up, file) {
        var executor=$("select#1_executor option:selected").attr('value');
        up.settings.url =  up.settings.url+"?id="+executor;
    });
    uploader.bind('FileUploaded', function(up, file, response) {
        response = jQuery.parseJSON(response.response );
        if (typeof response.error !== 'undefined'){
            if (typeof response.error.code !== 'undefined'){
                uploader.trigger('Error', {
                    code : response.error.code,
                    message : response.error.message,
                    details : response.details,
                    file : file
                });
            }
        }
        if( (uploader.total.uploaded + 1) >= uploader.files.length && (typeof response.error === 'undefined'))
        {
            window.location = '//ccimogilev.by';
        }
    });
});