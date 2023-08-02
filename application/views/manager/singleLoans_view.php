<div class="card">
    <div class="card-body">
        <div class="card-title lead">APPLICATION MANAGER</div><hr>
        <div class="card-text">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <p>
                        <label for="idNo"><strong>ID NUMBER:</strong></label>
                        <?= strtoupper($loan['id_number']) ?>
                    </p>
                    <p>
                        <label for="fullName"><strong>FULL NAME:</strong></label>
                        <?= strtoupper($loan['first_name'].' '.$loan['last_name']) ?>
                    </p>
                    <p>
                        <label for="occupution"><strong>OCCUPATION:</strong></label>
                        <?= strtoupper($loan['occupation']) ?>
                    </p>
                </div>
                <div class="col-sm-12 col-md-6">
                    <p>
                        <label for="loanType"><strong>LOAN TYPE:</strong></label>
                        <?= strtoupper($loan['type']) ?>
                    </p>
                    <p>
                        <label for="interest"><strong>INTEREST:</strong></label>
                        <?= $loan['interest'].'%' ?>
                    </p>
                    <p>
                        <label for="Status"><strong>STATUS</strong></label> 
                        <?= strtoupper($loan['status']) ?>  
                    </p>
                </div>
                <div class="col-12 p-2">
                    <p class="text-muted">TRANSACTIONS</p><hr>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>AMOUNT BORROWED</th>
                                <th>AMOUNT TO PAY</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $loan['amount_borrowed'] ?></td>
                                <td><?= $loan['amount_to_pay'] ?></td>
                            </tr>
                        </tbody>
                    </table> 
                </div>
                <?php if ($loan['status'] == 'pending'): ?>
                <div class="col-12">
                    <a class="btn btn-outline-primary" 
                    href="<?= site_url('manager/approveLoan/'.$loan['id']); ?>">Approve</a>
                    <a href="<?= site_url('manager/disapproveLoan/'.$loan['id']) ?>" 
                    class="btn btn-outline-danger">Disapprove</a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>