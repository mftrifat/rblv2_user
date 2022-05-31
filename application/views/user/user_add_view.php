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
<div>
    <?php echo form_open(); ?>
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-2">
                <label style="padding-top: 10px;">User Type</label>
            </div>
            <div class="col-md-4">
                <select class="basic-single form-select shadow-none form-control-line" id="user_type_id" name="user_type_id" required>
                    <!-- <option value="" disabled selected>--- Select User Type ---</option> -->
                    <option value="1_Input User" selected>Input User</option>
                </select>
            </div>
            <div class="col-md-4">
            </div>
        </div>
        <br>
        <div class="row" id="parent" hidden>
            <div class="col-md-2">
            </div>
            <div class="col-md-2">
                <label style="padding-top: 10px;">Admin Name</label>
            </div>
            <div class="col-md-4">
                <select class="basic-single form-select shadow-none form-control-line" id="parent_user_id" name="parent_user_id">
                    <option value="<?php echo $this->session->userdata('user_id') ?>" selected><?php echo $this->session->userdata('user_id') ?></option>
                </select>
            </div>
            <div class="col-md-4">
            </div>
        </div>
        <br id="parent_br" hidden>
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-2">
                <label style="padding-top: 10px;">New User Full Name</label>
            </div>
            <div class="col-md-4">
                <input type="text" id="new_full_name" name="new_full_name" class="form-control form-control-line" maxlength="120" required value="<?php if($this->input->post('new_full_name')) echo $this->input->post('new_full_name'); ?>">
            </div>
            <div class="col-md-4">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-2">
                <label style="padding-top: 10px;">New Username</label>
            </div>
            <div class="col-md-4">
                <input type="text" id="new_user_name" name="new_user_name" class="form-control form-control-line" maxlength="64" required value="<?php if($this->input->post('new_user_name')) echo $this->input->post('new_user_name'); ?>">
            </div>
            <div class="col-md-4">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">&nbsp;<br></div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 text-center">
                <?php if(validation_errors()) echo validation_errors(); ?>
                <button class="btn btn-success text-white mb-2" id="submit" name="submit" value="submit">Create New User&nbsp;&nbsp;<span><i class="fa fa-check"></i></span></button>
            </div>
        </div>
    </form>
</div>