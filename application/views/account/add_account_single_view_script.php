<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script>
    $(document).ready(function() {
        var load_email = 0;
        var clicks = 0;

        $('select[name="category_id"]').on('change', function() {
            var category_id = $(this).val();
            load_email = 0;
            if(category_id) {
                $('#email_btn').attr('hidden', true);
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

        function is_load_email(sub_category_id) {
            if(sub_category_id) {
                $.ajax({
                    url: 'ajax-is-load-email/'+sub_category_id,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        load_email = data[0]['load_email'];
                        load_sub_category(sub_category_id);
                    }
                });
            }
        }

        $('select[name="sub_category_id"]').on('change', function() {
            var sub_category_id = $(this).val();
            $('#input_form').empty();
            is_load_email(sub_category_id);
            
        });

        function load_sub_category(sub_category_id){
            if(sub_category_id) {
                $.ajax({
                    url: 'ajax-get-field-info/'+sub_category_id,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('#input_form').removeAttr('hidden');
                        form_show(data);
                    }
                });
            } else {
                $('#input_form').attr('hidden', true);
            }
        }

        function form_show(data){
            $.each(data, function( key, value ) {
                var field_name = value['field_name'];
                var field_type = value['field_type'];
                var field_id = value['field_id'];
                var field_seq = value['seq'];
                var field_length = value['field_length'];
                if(value['field_source'] !== null) {
                    if(value['field_source'].indexOf("field_data_") >= 0){
                        var field_src = value['field_source'];
                    } else {
                        var field_src = "";
                    }
                } else {
                    var field_src = '';
                }

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
                html += '<input type="' + field_type + '" id="' + field_id + field_seq + '" name="' + field_id + field_seq + '"';
                if(field_src !== '') {
                    html += ' src="' + field_src + '" ';
                }
                html += ' class="form-control form-control-line" maxlength="' + field_length + '" ' + field_required + '>';
                html += '</div>';
                $('#input_form').append(html);
            });

            html = '';
            html += '<div class="row"><div class="col-md-12">&nbsp;<br><br></div></div>';
            html += '<div class="row"><div class="col-md-5"></div><div class="col-md-2">';
            html += '<button class="btn btn-success text-white mb-2" id="submit" name="submit" value="submit">Submit&nbsp;&nbsp;<span><i class="fa fa-check"></i></span></button>';
            $('#input_form').append(html);

            if(load_email == 1) {
                $('#email_btn').removeAttr('hidden');
                clicks = 0;
            } else {
                $('#email_btn').attr('hidden', true);
            }
        }

        $('a#get_email').on('click', function() {
            if(clicks === 0){
                $.ajax({
                    url: 'ajax-load-email',
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('input.form-control').each(function() {
                            if($(this).attr('src') !== undefined) {
                                $(this).val(data[0][$(this).attr('src')]);
                            }
                        });
                        $('#input_form').append('<input type="hidden" id="loaded_email_id" name="loaded_email_id" value="'+data[0]['id']+'">');
                    }
                });                
            }
            clicks++;
        });
    });
</script>