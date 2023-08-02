<div class="card">
    <div class="card-body">
        <div class="card-title lead">USER DETAILS</div><hr>
        <div class="card-text animated slideInDown">
            <div class="row">
                <div class="col-12">
                    <p class="row">
                        <span class="text-muted col-sm-6 col-md-2">ID NUMBER: </span>
                        <span class="col-sm-6 col-md-10"><?= $details['id_number'] ?></span>
                    </p>
                </div>
                <div class="col-12">
                    <p class="row">
                        <span class="text-muted col-sm-6 col-md-2">FULL NAME: </span>
                        <span class="col-sm-6 col-md-10"><?= $details['first_name'].' '.$details['last_name'] ?></span>
                    </p>
                </div>
                <div class="col-12">
                    <p class="row">
                        <span class="text-muted col-sm-6 col-md-2">REF NO: </span>
                        <span class="col-sm-6 col-md-10">##<?= $details['loan_id'] ?></span>
                    </p>
                </div>
                <div class="col-12">
                    <p class="row">
                        <span class="text-muted col-sm-6 col-md-2">AMOUNT: </span>
                        <span class="col-sm-6 col-md-10"><?= number_format($details['amount_borrowed'],2) ?></span>
                    </p>
                </div>
                
                <div class="col-sm-12 col-md-6">
                    <p><span class="text-muted">DATE TAKEN: </span> <?= $details['date_borrowed'] ?></p>
                </div>
                <div class="col-sm-12 col-md-6">
                    <p><span class="text-muted">LAST PAYMENT DATE: </span> 30-06-2018</p>
                </div>
            </div>
            <div class="table-responsive mt-3 animated slideInLeft">
                <table class="table table-striped table-hover dt_table">
                    <thead>
                        <tr>
                            <th>REFERENCE</th>
                            <th>AMOUNT</th>
                            <th>DATE PAID</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($payments as $payment): ?>
                        <tr>
                            <td><?= $payment['id'] ?></td>
                            <td><?= number_format($payment['amount'],2) ?></td>
                            <td><?= $payment['date_paid'] ?></td>    
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="text-success text-right lead" colspan="3">Balance: <?= number_format($details['balance'],2) ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>