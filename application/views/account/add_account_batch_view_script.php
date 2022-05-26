<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script>
    $(document).ready(function() {
        $('select[name="category_id"]').on('change', function() {
            var category_id = $(this).val();
            $('#link_upload').attr('hidden', true);
            if(category_id) {
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
                $('#link_upload').attr('hidden', true);
                $('select[name="sub_category_id"]').empty();
                $('select[name="sub_category_id"]').append('<option value="null" disabled selected>--- Select Sub-Category ---</option>');
            }
        });

        $('select[name="sub_category_id"]').on('change', function() {
            var sub_category_id = $(this).val();
            if(sub_category_id) {
                $.ajax({
                    url: 'ajax-get-template-info/'+sub_category_id,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('#link_upload').removeAttr('hidden');
                        // console.log(data);
                        $('#upload_csv_template').attr("href", data[0]['template_link_csv']);
                        $('#upload_txt_template').attr("href", data[0]['template_link_txt']);
                    }
                });
            } else {
                $('#link_upload').attr('hidden', true);
            }
        });
    });
</script>