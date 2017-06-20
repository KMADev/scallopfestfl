/**
 * For Ajax Requests thru WP. Localized as wpAjax.
 */
function someAjaxFunction ( variable ){
    $.ajax({
        type : 'post',
        dataType : 'json',
        url : wpAjax.ajaxurl,
        data : { action: 'get_info', sod_id : variable },
        success: function(response) {
            console.log(response);

            //do something with jQuery or whatever.

        }
    });
}