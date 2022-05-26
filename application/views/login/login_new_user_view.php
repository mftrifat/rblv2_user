<div class="col-md-4"></div>
<div class="col-md-4">
    <div class="col-md-1"></div>
    <div class="col-md-10 box">
        <h3>
            <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/img/logo.png" style="width:180px; padding-top:15px;"></a>
            <!-- <br><br>
            CIB Reporting System -->
            <br>
        </h3>
        <hr>
        <div class="form-group">
            <h4>Request New User ID</h4>
<!-- 
            <label><input type="radio" class="form-switch" name="colorCheckbox" value="existing" data-id="a" checked> Existing Branch</label>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <label><input type="radio" class="form-switch" name="colorCheckbox" value="new" data-id="b"> New Branch</label>

            <div class="form form-a active"> form a </div>
            <div class="form form-b"> form b </div> -->

            <?php 
            echo form_open('newuser');
            if($this->session->flashdata('msg_new_user')) 
            {
                echo "<br><br>".$this->session->flashdata('msg_new_user')."<br><br><br><br>";
            }
            else 
            {
            ?>
                <input type="text" id="user_name" name="user_name" placeholder="User Name" autocomplete="on" class="form-control margin-bottom-05" value="<?php echo set_value('user_name'); ?>" required>
                <input type="password" id="password" name="password" placeholder="Password" autocomplete="on" class="form-control margin-bottom-05" required><span toggle="#password" class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Retype Password" autocomplete="off" class="form-control margin-bottom-05" required><span toggle="#confirm_password" class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>
                <input type="email" id="user_email" name="user_email" placeholder="User Email" autocomplete="on" class="form-control margin-bottom-05" value="<?php echo set_value('user_email'); ?>" required>
                <div id="msg"></div>
                <br>
                <?php if($this->session->flashdata('msg_new_user')) echo $this->session->flashdata('msg_new_user')."<br><br>"; ?>
                <?php echo validation_errors(); ?>
                <button type="submit" class="btn btn-primary" name="log" value="Sign in"><i class="fa fa-sign-in"></i> Request</button>
                <p></p>
            <?php
            }
            ?>
                <a class="btn btn-danger" href="<?php echo base_url();?>"><i class="fa fa-arrow-left"></i> Back To Sign In</a>
            </form>            
        </div>
        <?php $this->load->view('login/login_footer_view'); ?>
    </div>
    <div class="col-md-1"></div>
</div>
<div class="col-md-4"></div>