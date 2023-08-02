<div class="card animated slideInDown signForm mt-5">
    <div class="card-body">
        <div class="card-text">
        <?php if(validation_errors() != NULL):?>
            <div class="alert alert-danger">
                <?= validation_errors(); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($message) && $message != ''): ?>
            <div class="alert alert-<?= $type; ?>">
                <?= $message; ?>
            </div>
        <?php endif; ?>
            <form action="<?= site_url('accounts/loanApplication'); ?>" method="post">
                <div class="form-group">
                    <label for="id_number">ID NUMBER:</label>
                    <input type="text" name="id_no" placeholder="ID NUMBER" class="form-control">
                </div>
                <div class="form-group">
                    <label for="amount">AMOUNT:</label>
                    <input type="text" name="amount" placeholder="AMOUNT" class="form-control" id="amount">
                </div>
                <div class="form-group">
                    <label for="type">LOAN TYPE</label>
                    <?= form_dropdown("type",$loan_type,1,'class="form-control"'); ?>
                </div>
                <div class="form-group">
                    <button class="btn btn-outline-primary" type="submit">APPLY</button>
                </div>
            </form>
        </div>
    </div>
</div>