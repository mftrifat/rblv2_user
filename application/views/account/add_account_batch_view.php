<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php echo form_open('add_account_single_action'); ?>
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
                        <option value="<?php echo $key->id; ?>"><?php echo $key->   category_name; ?></option>

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
        <!-- 
        <div class="col-md-1">
            <button class="btn btn-success text-white mb-2" id="submit" name="search" value="search">Search</button>
        </div>
         -->
    </div>
    <br>
    <div class="row" id="link_upload" hidden>
        <div class="col-md-3">
            <label style="padding-top: 10px;">Get Upload Template --> </label>
        </div>
        <div class="col-md-3">
            <a id="upload_csv_template" class="btn btn-success text-white mb-2">
                <i class="mdi mdi-file-excel"></i>
                <span class="hide-menu">CSV</span>
            </a>
        </div>
        <div class="col-md-3">
            <a id="upload_txt_template" class="btn btn-success text-white mb-2">
                <i class="mdi mdi-clipboard-text"></i>
                <span class="hide-menu">TXT</span>
            </a>
        </div>
    </div>
</form>