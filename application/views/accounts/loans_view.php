<div class="card">
    <div class="card-body">
        <div class="card-text text-right">
            <a href="<?= base_url(); ?>index.php/accounts/pay_loan" class="btn btn-outline-danger btn-sm">Pay Loan</a>
            <a href="<?= base_url(); ?>index.php/accounts/apply_loan" class="btn btn-outline-success btn-sm">Apply Loan</a>
        </div>
    </div>
</div>
<div class="table-responsive mt-2 animated slideInLeft">
    <table class="table table-striped table-hover dt_table">
        <thead>
            <tr>
                <th>#REFNO</th>
                <th>ID NO</th>
                <th>NAME</th>
                <th>AMOUNT</th>
                <th>INTEREST %</th>
                <th>TO PAY</th>
                <th>BALANCE</th>
                <th>STATE</th>
                <th>STATUS</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($loans as $loan): ?>
            <tr>
                <td><?= $loan["id"] ?></td>
                <td><?= $loan["id_number"] ?></td>
                <td><?= strtoupper($loan["first_name"]." ".$loan["last_name"]); ?></td>
                <td><?= number_format($loan["amount_borrowed"],2); ?></td>
                <td><?= $loan["interest"] ?></td>
                <td><?= number_format($loan["amount_to_pay"],2); ?></td>
                <td><?= number_format($loan["balance"],2); ?></td>
                <td><?= $loan["state"]; ?></td>
                <?php 
                    $status = $loan["status"];
                    
                    switch($status){
                        case "pending":
                            $color = "primary";
                            break;
                        case "not approved":
                            $color = "danger";
                            break;
                        case "approved":
                            $color = "success";
                            break;
                        default:
                            $color = "warning";
                    }
                ?>
                <td>
                    <span class="text-<?= $color; ?>"><?= $loan["status"]; ?></span>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>