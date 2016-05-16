$(function () {
    var uploader = $('#uploader');
    if (uploader.length) {
        var href = uploader.data('href');
        uploader.plupload({
            // General settings
            runtimes: 'html5,flash,silverlight,html4',
            url: href,
            // Maximum file size
            max_file_size: '15mb',
            max_file_count: 10,
            multi_selection: true,
            chunk_size: '1mb',
            resize: {
                width: 200,
                height: 200,
                quality: 90,
                crop: true // crop to exact dimensions
            },
            filters: [
                {title: "Excel files", extensions: "xls,xlsx"}
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
        var uploader = uploader.plupload('getUploader');
        uploader.bind('FileUploaded', function (up, file, response) {
            response = jQuery.parseJSON(response.response);
            if (!!response.error) {
                if (!!response.error.code) {
                    $.each(response.error.message, function(i, val) {
                        uploader.trigger('Error', {
                            code: response.error.code,
                            message: val
                        });

                    });
                }
            }
            if ((uploader.total.uploaded + 1) >= uploader.files.length && (typeof response.error === 'undefined')) {
                window.location = '/';
            }
        });
    }
});