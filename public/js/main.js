'use strict';
function init(){
    $('#loginForm').submit(function(e) {
        $('#formMes').text('');
        e.preventDefault();
        var data = $(this).serialize(),
            method = $(this).attr('method'),
            action = $(this).attr('action');
        $.ajax({
            type: method,
            url: action,
            data: data
        }).done(function(data) {
            console.log(data);
            $('#formMes').text(data);

        }).fail(function(er) {
            console.log(er)});
    });
}
window.onload = init;
