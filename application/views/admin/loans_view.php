<div class="row">
    <div class="col-12">
        <?php if ($message != null): ?>
            <div class="alert alert-<?= $type; ?>">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <p><?= $message; ?></p>
            </div>
        <?php endif; ?>
    </div>
    <div class="col-sm-12 col-md-4 col-lg-3">
        <div class="card animated slideInLeft card-title--floating">
            <div class="card-body">
                <div class="card-title bg-success text-center">LOAN DETAILS</div><hr>
                <div class="card-text">
                    <a href="<?= base_url(); ?>index.php/admin/addLoan" class="btn btn-sm btn-block btn-outline-dark">
                        Add Loan
                    </a>
                    <div class="summary mt-4">
                        <p>
                            <label for="totalLoans">Total Loans:</label>
                            <span class="float-right"><?= $summary["count"] ?></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 col-lg-9">
        <div class="card animated slideInRight">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover dt_table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NAME</th>
                                <th>INTEREST</th>
                                <th>MANAGE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($loans as $loan): ?>
                            <tr>
                                <td><?= $loan["id"] ?></td>
                                <td><?= $loan["name"] ?></td>
                                <td><?= $loan["interest"] ?></td>
                                <td>
                                    <a href="<?= base_url('index.php/admin/loanEdit/').$loan["id"] ?>" class="btn btn-sm btn-outline-danger">
                                    Edit
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>