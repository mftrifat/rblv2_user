<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<h4 style="color: red"> 
<?php
    $msg = $this->session->userdata('msg');
    $cls = $this->session->userdata('cls');
    if ($msg) {
?>
        <div class="alert alert-warning alert-dismissible fade show">
            <!-- <a href="#" class="close" data-dismiss="alert" aria-label="Close">&times;</a> -->
            <strong><?php if(!empty($cls)) echo $cls; else echo "Error!!!"?></strong> <font color="red"> <?php echo $msg; ?></font>
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
<?php
        $this->session->unset_userdata('msg');
        $this->session->unset_userdata('cls');
    }
?>
</h4>

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

<?php if(!empty($rejected_accounts)){ ?>
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
                    <th scope="col">Edit & Submit Again</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (!empty($rejected_accounts)) {
                        $count = 1;
                        foreach ($rejected_accounts as $row) {
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
                                if($row->flag_rejected == 1){
                                    echo ", Rejected";
                                }
                            } else if($row->flag_locked) {
                                echo "Locked";
                            } else {
                                echo "Not Checked";
                            }
                            echo "</td>";

                            echo "</td>";
                            echo "<td>
                                    <a href=\"".base_url()."edit_account?id=".$row->Id."&cat=".$selected_sub_category_id."\" onclick=\"return confirm('Do you really want to Edit?');\">
                                        <i class=\"fa fa-pencil-square fa-2x\" title=\"Release\" style=\"color:red;\"></i>
                                    </a>
                                </td>";
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