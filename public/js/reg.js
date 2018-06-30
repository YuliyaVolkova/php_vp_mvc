'use strict';
function init(){
    $('#regForm').submit(function(e) {
        $('#formMes').text('');
        e.preventDefault();
       // var data = $(this).serialize(),
            var data = new FormData($(this)[0]),
            method = $(this).attr('method'),
            action = $(this).attr('action');
        $.ajax({
            type: method,
            url: action,
            data: data,
            cache: false,
            contentType: false,
            processData: false
        }).done(function(data) {
            console.log(data);
            $('#formMes').text(data);
        }).fail(function(er) {
            console.log(er)});
    });
}
window.onload = init;
