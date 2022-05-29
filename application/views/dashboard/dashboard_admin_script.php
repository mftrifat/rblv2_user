<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script>
    $('.counter').each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
            duration: 5000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });

    $('.counter_money').each(function () {
        var size = $(this).text().split(".")[1] ? $(this).text().split(".")[1].length : 0;
        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
        }, {
            duration: 5000,
            easing: 'swing',
            step: function (now) {
                $(this).text(parseFloat(now).toFixed(size));
            }
        });
    });
</script>