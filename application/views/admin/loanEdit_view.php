<div class="card signForm">
    <div class="card-body">
        <?php if (validation_errors() != null): ?>
            <div class="alert alert-danger">
                <?= validation_errors(); ?>
            </div>
        <?php endif; ?>
        <form action="<?= base_url(); ?>index.php/admin/editLoan" method="post">
            <div class="form-group">
                <label for="date added" class="text-muted">Added On: <?= $loan["date_added"] ?></label>
                <input type="hidden" name="loanId" value="<?= $loan["id"] ?>">
            </div>
            <div class="form-group">
                <label for="name">Loan Name:</label>
                <input type="text" name="loanName" value="<?= set_value("loanName",$loan["name"]) ?>" class="form-control" id="name">
            </div>
            <div class="form-group">
                <label for="interest">Interest:</label>
                <input type="text" name="interest" value="<?= set_value("interest",$loan["interest"]) ?>" class="form-control" id="interest">
            </div>
            <div class="form-group text-right">
                <button class="btn btn-outline-danger" type="submit">Edit</button>
            </div>
        </form>
    </div>
</div>