<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php 
    $checked = $this->ModelCommon->get_count_user_cond($this->session->userdata('user_id'), "checked");
    $rejected = $this->ModelCommon->get_count_user_cond($this->session->userdata('user_id'), "rejected");
    $total = $this->ModelCommon->get_count_user_submitted($this->session->userdata('user_id'));
    $pending = $total-$rejected-$checked;
?>

<div class="row">
    <!-- Accounts -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Summary - Accounts</h4>
                <div class="d-flex align-items-center flex-row m-t-30">
                    <div class="display-5 text-info"><i class="mdi mdi-account-plus"></i>
                        <span class="counter"><?php echo $total; ?></span></div>

                    <div class="m-l-10">
                        <h3 class="m-b-0">Total Accounts Submitted</h3>
                    </div>
                </div>
                <ul class="row list-style-none text-center m-t-30">
                    <li class="col-4">
                        <h4 class="text-info"><i class="mdi mdi-checkbox-marked-circle-outline"></i></h4>
                        <h3 class="m-t-5 counter"><?php echo $checked ?></h3>
                        <span class="d-block text-muted">Checked</span>
                    </li>
                    <li class="col-4">
                        <h4 class="text-info"><i class="mdi mdi-minus-circle-outline"></i></h4>
                        <h3 class="m-t-5 counter"><?php echo $pending ?></h3>
                        <span class="d-block text-muted">Review Pending</span>
                    </li>
                    <li class="col-4">
                        <h4 class="text-info"><i class="mdi mdi-close-circle-outline"></i></h4>
                        <h3 class="m-t-5 counter"><?php echo $rejected ?></h3>
                        <span class="d-block text-muted">Rejected</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Payments -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Summary - Payment</h4>
                <div class="d-flex align-items-center flex-row m-t-30">
                    <div class="display-5 text-info"><i class="mdi mdi-cash-100"></i>
                        <span class="counter_money"><?php echo $this->ModelCommon->get_user_balance($this->session->userdata('user_id')); ?></span></div>
                    <div class="m-l-10">
                        <h3 class="m-b-0">Total Outstanding Balance</h3>
                    </div>
                </div>
                <ul class="row list-style-none text-center m-t-30">
                    <li class="col-6">
                        <h4 class="text-info"><i class="mdi mdi-cash"></i></h4>
                        <h3 class="m-t-5 counter_money"><?php echo $this->ModelCommon->get_user_balance_cond($this->session->userdata('user_id'), "income"); ?></h3>
                        <span class="d-block text-muted">Total Income</span>
                    </li>
                    <!-- <li class="col-4">
                        <h4 class="text-info"><i class="mdi mdi-cash"></i></h4>
                        <h3 class="m-t-5 counter_money"><?php //echo $this->ModelCommon->get_user_pending($this->session->userdata('user_id')); ?></h3>
                        <span class="d-block text-muted">Pending Income</span>
                    </li> -->
                    <li class="col-6">
                        <h4 class="text-info"><i class="mdi mdi-cash-multiple"></i></h4>
                        <h3 class="m-t-5 counter_money"><?php echo $this->ModelCommon->get_user_balance_cond($this->session->userdata('user_id'), "cashout"); ?></h3>
                        <span class="d-block text-muted">Total Cashout</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- Recent comment and chats -->
<!-- ============================================================== -->