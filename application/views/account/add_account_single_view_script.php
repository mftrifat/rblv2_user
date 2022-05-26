<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script>
    $(document).ready(function() {
        $('select[name="category_id"]').on('change', function() {
            var category_id = $(this).val();
            if(category_id) {
                $('#input_form').attr('hidden', true);
                $.ajax({
                    url: 'ajax-get-sub-category/'+category_id,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="sub_category_id"]').empty();
                        $('select[name="sub_category_id"]').append('<option value="null" disabled selected>--- Select Sub-Category ---</option>');
                        $.each(data, function(key, value) {
                            $('select[name="sub_category_id"]').append('<option value="'+ value.id +'">'+ value.category_name +'</option>');
                        });
                    }
                });
            }else{
                $('#input_form').attr('hidden', true);
                $('select[name="sub_category_id"]').empty();
                $('select[name="sub_category_id"]').append('<option value="null" disabled selected>--- Select Sub-Category ---</option>');
            }
        });

        $('select[name="sub_category_id"]').on('change', function() {
            var sub_category_id = $(this).val();
            $('#input_form').empty();

            if(sub_category_id) {
                $.ajax({
                    url: 'ajax-get-field-info/'+sub_category_id,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('#input_form').removeAttr('hidden');

                        $.each(data, function( key, value ) {
                            var field_name = value['field_name'];
                            var field_type = value['field_type'];
                            var field_id = value['field_id'];
                            var field_seq = value['seq'];
                            var field_length = value['field_length'];

                            if(value['field_required'] != null){
                                var field_required = value['field_required'];
                            } else {
                                var field_required = '';
                            }

                            html = '';
                            html += '<div class="col-md-2">';
                            html += '<label style="padding-top: 10px;">' + field_name + '</label>';
                            html += '</div>';
                            html += '<div class="col-md-4">';
                            html += '<input type="' + field_type + '" id="' + field_id + field_seq + '" name="' + field_id + field_seq + '" class="form-control form-control-line" maxlength="' + field_length + '" ' + field_required + '>';
                            html += '</div>';
                            $('#input_form').append(html);
                        });

                        html = '';
                        html += '<div class="row"><div class="col-md-12">&nbsp;<br><br></div></div>';
                        html += '<div class="row"><div class="col-md-5"></div><div class="col-md-2">';
                        html += '<button class="btn btn-success text-white mb-2" id="submit" name="submit" value="submit">Submit&nbsp;&nbsp;<span><i class="fa fa-check"></i></span></button>';
                        $('#input_form').append(html);
                    }
                });
            } else {
                $('#input_form').attr('hidden', true);
            }
        });
    });
</script>