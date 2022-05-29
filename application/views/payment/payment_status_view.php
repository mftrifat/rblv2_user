<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php if(!empty($all_payments)){ ?>
<div>
    <div class="table-responsive" id="view_table">
        <table id="example2" class="display table table-bordered table-striped" style="width: 98% !important;">
            <input type="hidden" id="table_load" value="loaded"><br>
            <thead>
                <tr class="text-center" id="table_header">
                    <th scope="col">#</th>
                    <th scope="col">Payment Status</th>
                    <th scope="col">Request Date</th>
                    <th scope="col">Request Amount</th>
                    <th scope="col">Charge Amount</th>
                    <th scope="col">Payment Amount</th>
                    <th scope="col">Payment Date</th>
                    <th scope="col">Payment Method</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (!empty($all_payments)) {
                        $count = 1;
                        foreach ($all_payments as $row) {
                            echo "<tr>";
                            echo "<td scope=\"col\" class=\"text-center\">".$count."</td>";
                            echo "<td scope=\"col\" class=\"text-center\">";
                            if($row->payment_status == 0){
                                echo "Reqested";
                            } else if($row->payment_status == 1) {
                                echo "Paid";
                            } else if($row->payment_status == -1) {
                                echo "Rejected";
                            }
                            echo "</td>";
                            echo "<td scope=\"col\" class=\"text-center\">".$row->request_date."</td>";
                            echo "<td scope=\"col\" class=\"text-center\">".$row->request_amount."</td>";
                            echo "<td scope=\"col\" class=\"text-center\">".$row->charge_amount."</td>";
                            echo "<td scope=\"col\" class=\"text-center\">".$row->payment_amount."</td>";
                            echo "<td scope=\"col\" class=\"text-center\">".$row->payment_date."</td>";
                            echo "<td scope=\"col\" class=\"text-center\">".$row->payment_remarks."</td>";
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