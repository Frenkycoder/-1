$(function() {
    $('input[type=button]').on('click', function () {
        var name = $('input[name=name]').val(),
            phone = $('input[name=phone]').val(),
            email = $('input[name=email]').val(),
            street = $('input[name=street]').val(),
            home = $('input[name=home]').val(),
            part = $('input[name=part]').val(),
            apt = $('input[name=appt]').val(),
            floor = $('input[name=floor]').val();
        $.ajax({
            url: '/form.php',
            method: 'post',
            data: {
                name: name,
                phone: phone,
                mail: email,
                street: street,
                home: home,
                part: part,
                apt: apt,
                floor: floor
            }
        }).done(function (data) {
           $('.order__form-label').html(data);
        });
    });

});