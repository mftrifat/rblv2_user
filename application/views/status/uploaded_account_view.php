<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php echo form_open(); ?>
    <div class="row">
        <div class="col-md-2">
            <label style="padding-top: 10px;">Select Category</label>
        </div>
        <div class="col-md-4">
            <select class="basic-single form-select shadow-none form-control-line" id="category_id" name="category_id" required>
                <option value="null" disabled selected>--- Select Category ---</option>
                <?php
                if (!empty($category_list)) {
                    foreach ($category_list as $key) {
                ?>
                        <option value="<?php echo $key->id; ?>"><?php echo $key->category_name; ?></option>
                <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class="col-md-5">
            <select class="basic-single form-select shadow-none form-control-line" id="sub_category_id" name="sub_category_id" required>
                <option value="null" disabled selected>--- Select Sub-Category ---</option>
            </select>
        </div>
        <div class="col-md-1" id="search_btn">
        </div>
    </div>
</form>

<?php if(!empty($all_accounts)){ ?>
<br>
<h5 class="page-title"><?php echo $this->ModelCommon->single_result('tbl_category','category_name','id',$selected_category_id)." > ".$this->ModelCommon->single_result('tbl_category','category_name','id',$selected_sub_category_id); ?></h5>
<br>
<div>
    <div class="table-responsive" id="view_table">
        <table id="example2" class="display table table-bordered table-striped" style="width: 98% !important;">
            <input type="hidden" id="table_load" value="loaded"><br>
            <thead>
                <tr class="text-center" id="table_header">
                    <th scope="col">#</th>
                    <?php
                        if (!empty($field_info)) {
                            $visible_field = array();
                            foreach ($field_info as $row) {
                                if($row->field_hidden == 0){
                                    array_push($visible_field,$row->seq);
                                    echo "<th scope=\"col\">".$row->field_name."</th>";
                                }
                            }
                        }
                    ?>
                    <th scope="col">Input Date</th>
                    <th scope="col">Input User</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (!empty($all_accounts)) {
                        $count = 1;
                        foreach ($all_accounts as $row) {
                            echo "<tr>";
                            echo "<td scope=\"col\">".$count."</td>";
                            foreach ($row as $key => $val) {
                                if(strpos($key, "a_data_") !== false){
                                    if(in_array(substr($key, -1), $visible_field)) {
                                        echo "<td scope=\"col\">".$this->encryption->decrypt($val)."</td>";
                                    }
                                }
                            }
                            echo "<td scope=\"col\">".$row->date_entry."</td>";
                            echo "<td scope=\"col\">".$row->full_name."</td>";
                            echo "<td scope=\"col\">";
                            if($row->flag_checked == 1){
                                echo "Checked";
                                if($row->flag_download == 1){
                                    echo ", Downloaded";
                                    if($row->flag_upload == 1){
                                        echo ", Uploaded";
                                        if($row->flag_used == 1){
                                            echo ", Used";
                                        } else {
                                            echo ", Not Used";
                                        }
                                    } else {
                                        echo ", Not Uploaded";
                                    }
                                } else {
                                    echo ", Not Downloaded";
                                }
                                if($row->flag_rejected == 1){
                                    echo ", Rejected";
                                }
                            } else if($row->flag_locked) {
                                echo "Locked";
                            } else {
                                echo "Not Checked";
                            }
                            echo "</td>";
                            echo "</tr>";
                            $count++;
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php } ?>