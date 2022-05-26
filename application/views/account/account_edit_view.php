<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
if(!empty($edit_account)) {
    $attrib = array('id' => 'editform');
    echo form_open('', $attrib); 
    foreach ($edit_account as $row) {
?>
    <input type="hidden" name="edit_id" value="<?php echo $row->Id; ?>">
    <input type="hidden" name="category_id" value="<?php echo $row->category; ?>">
    <input type="hidden" name="sub_category_id" value="<?php echo $row->sub_category; ?>">
    <div class="row">
        <h5 class="page-title"><?php echo $this->ModelCommon->single_result('tbl_category','category_name','id',$row->category)." > ".$this->ModelCommon->single_result('tbl_category','category_name','id',$row->sub_category); ?></h5>
    </div>
    <br>
    <div class="row" id="input_form">
<?php
        $category_select = $row->sub_category;
        $field_det = $this->ModelCommon->get_field_info($category_select);

        foreach ($field_det as $field_row) {
            $field_name = $field_row->field_name;
            $field_type = $field_row->field_type;
            $field_id = $field_row->field_id;
            $field_seq = $field_row->seq;
            $field_length = $field_row->field_length;

            $field_value = "a_data_".$field_seq;

            if($field_row->field_required != null){
                $field_required = $field_row->field_required;
            } else {
                $field_required = '';
            }

            echo '<div class="col-md-2">';
            echo '<label style="padding-top: 10px;">'.$field_name.'</label>';
            echo '</div>';
            echo '<div class="col-md-4">';
            echo '<input type="' . $field_type . '" id="'.$field_id.$field_seq.'" name="'.$field_id.$field_seq.'" class="form-control form-control-line" maxlength="'.$field_length.'" '.$field_required.' value="'.$this->encryption->decrypt($row->$field_value).'">';
            echo '</div>';
        }
?>
    </div>
    <div class="row">
        <div class="col-md-12">&nbsp;<br><br></div></div>
        <div class="row"><div class="col-md-5"></div><div class="col-md-2">
            <button class="btn btn-success text-white mb-2" id="submit" name="submit" value="submit" disabled>Submit&nbsp;&nbsp;<span><i class="fa fa-check"></i></span></button>
        </div>
    </div>
<?php 
    }
?>    
</form>
<?php 
}
?>