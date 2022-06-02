<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php 
if($this->session->userdata('user_access_level') == 11){    
    $account_income = $this->ModelPayments->total_account_income($this->session->userdata('user_id'));
    if(empty($account_income)) {
        $account_income = 0;
    }
    $commision_income = $this->ModelPayments->total_commission_income($this->session->userdata('user_id'));
    $total_income = $account_income+$commision_income;
    $total_cashout = $this->ModelPayments->total_cashout($this->session->userdata('user_id'));
    $current_balance = $total_income-$total_cashout;
?>
<div>
    <div class="table-responsive" id="view_table">
        <table class="display table table-bordered table-striped" style="width: 98% !important;">            
            <thead>
                <tr class="text-center" id="table_header">
                    <th scope="col">Account Income</th>
                    <th scope="col">Total Commission</th>
                    <th scope="col">Total Income</th>
                    <th scope="col">Total Cashout</th>
                    <th scope="col">Current Balance</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="col" class="text-center"><?php echo $account_income; ?></td>
                    <td scope="col" class="text-center"><?php echo $commision_income; ?></td>
                    <td scope="col" class="text-center"><?php echo $total_income; ?></td>
                    <td scope="col" class="text-center"><?php echo $total_cashout; ?></td>
                    <td scope="col" class="text-center"><?php echo $current_balance; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<br>
<?php } else {    
    $total_income = $this->ModelPayments->total_account_income($this->session->userdata('user_id'));
    $total_cashout = $this->ModelPayments->total_cashout($this->session->userdata('user_id'));
    $current_balance = $total_income-$total_cashout;
?>
<div>
    <div class="table-responsive" id="view_table">
        <table class="display table table-bordered table-striped" style="width: 98% !important;">            
            <thead>
                <tr class="text-center" id="table_header">
                    <th scope="col">Total Income</th>
                    <th scope="col">Total Cashout</th>
                    <th scope="col">Current Balance</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="col" class="text-center"><?php echo $total_income; ?></td>
                    <td scope="col" class="text-center"><?php echo $total_cashout; ?></td>
                    <td scope="col" class="text-center"><?php echo $current_balance; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<br>
<?php } ?>

<?php if(!empty($transaction_summary)){ ?>
<div>
    <div class="table-responsive" id="view_table">
        <table id="example2" class="display table table-bordered table-striped" style="width: 98% !important;">
            <input type="hidden" id="table_load" value="loaded"><br>
            <thead>
                <tr class="text-center" id="table_header">
                    <th scope="col">#</th>
                    <th scope="col">Transaction Type</th>
                    <th scope="col">Transaction Details</th>
                    <th scope="col">Transaction Date</th>
                    <th scope="col">Transaction Amount</th>
                    <th scope="col">Balance Before</th>
                    <th scope="col">New Balance</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (!empty($transaction_summary)) {
                        $count = 1;
                        foreach ($transaction_summary as $row) {
                            echo "<tr>";
                            echo "<td scope=\"col\" class=\"text-center\">".$count."</td>";
                            echo "<td scope=\"col\" class=\"text-center\">".$row->transaction_type."</td>";
                            if($row->batch_category) {
                            echo "<td scope=\"col\">Category: ".$this->ModelCommon->single_result('tbl_category','category_name','id',$row->batch_category)."<br>Input: ".$row->total_input."<br>Accepted: ".$row->total_checked."<br>Rejected: ".$row->total_rejected."</td>";
                            } else {
                                echo "<td scope=\"col\" class=\"text-center\">".$row->remarks."</td>";
                            }                            
                            echo "<td scope=\"col\" class=\"text-center\">".$row->transaction_date."</td>";
                            echo "<td scope=\"col\" class=\"text-center\">".$row->total_amount."</td>";
                            echo "<td scope=\"col\" class=\"text-center\">".$row->balance_before."</td>";
                            echo "<td scope=\"col\" class=\"text-center\">".$row->balance_new."</td>";
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