$(function () {
    $('.loading-wrap').hide();
    $(document).ajaxStart(function () {
        return $('.loading-wrap').stop().fadeIn();
    }).ajaxStop((function () {
        return $('.loading-wrap').stop().fadeOut();
    }));

    $(document).on('click', '.convert', function (e) {
        e.preventDefault();

        var param = {
            amount: +$('input[name=amount]').val(),
            convert_to: $('select[name=convert_to] :selected').val()
        };

        $.ajax({
            type: "GET",
            dataType: 'json',
            cache: false,
            url: "api/get_rate.php?" + $.param(param)
        }).done(function (response) {
            if (response) {
                $('.error').html('');
                $('.result').html(Math.round(response['result'] * 100) / 100 + ' ' + response['to']);
            } else {
                alert('Ошибка с получением данных.');
            }
        }).fail(function (response) {
            $('.error').html(response['responseJSON']['error']);
        });
    });
});