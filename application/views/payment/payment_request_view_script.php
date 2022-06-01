<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script>
    $(document).ready(function() {        
        $('#payment_amount').val($('#request_amount').val()-$('#charge_amount').val());
        $('#charge_amount').val($('#payment_charge').val()*$('#charge_amount').val()/100);

        $('#request_amount').on('change', function() {
            var request_amount = $(this).val();
            var payment_charge = $('#payment_charge').val();
            $('#charge_amount').val(Math.round(request_amount*payment_charge/100));
            $('#payment_amount').val(request_amount - $('#charge_amount').val());
        });
    });
</script>