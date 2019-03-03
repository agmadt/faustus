$(document).ready(function () {

    $('.delete-button').click(function (e) {
        var message = 'Are you sure?';
        if ($(this).attr('data-delete-message')) {
            message = $(this).attr('data-delete-message');
        }

        var conf = confirm(message);

        if (!conf) {
            return false;
        }
    })

});