;
$(document).ready(function() {
    $(".address-form").submit(function (e) {
        e.preventDefault();
        let url  = $(this).attr('action');
        var form = $(this);
        var fd   = form.serialize();
        let method = form.find("input[name=_method]").val();
        clearErrors();
        $.ajax({
            type     : method ? method : 'post',
            url      : url,
            data     : fd,
            success  : function (data) {
                if (data.success) {
                    swal({
                        type             : 'success',
                        title            : data.messages,
                    }).then(function () {
                        location.reload();
                    });

                }
            },
            error    : function (jqXHR, textStatus, errorThrown) {
                if (jqXHR.status == 422) {

                    $.each(jqXHR.responseJSON.errors, function (field, messages) {
                        $('.address-form').find(":input[name=" + field + "]").parent().addClass('has-error');

                        $('.address-form').find(":input[name=" + field + "]").parent()
                            .append("<span class=\"help-block\">" +
                                "<strong>" + messages[0] + "</strong>" +
                                "</span>");
                    });
                }
            }
        });
    });

    function clearErrors() {
        $('span[class=help-block]').remove();
        $('form').find('.address-form').removeClass('has-error');
    }

});
