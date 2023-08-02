<div class="card animated slideInDown signForm">
    <div class="card-body">
        <?php if (isset($message) && $message != null): ?>
            <div class="alert alert-<?= $type; ?>">
                <?= $message; ?>
            </div>
        <?php endif; ?>
        <?php if (validation_errors() != null): ?>
            <div class="alert alert-danger">
                <?= validation_errors() ?>
            </div>
        <?php endif; ?>
        <div class="card-text">
            <form action="<?= site_url("accounts/loan_pay"); ?>" method="post">
                <div class="form-group">
                    <label for="id_no">ID NUMBER</label>
                    <input type="text" name="id_no" value="<?= set_value('id_no'); ?>" class="form-control" id="id_no">
                </div>
                <div class="form-group">
                    <label for="reference">REFERENCE NO</label>
                    <input type="text" name="reference" value="<?= set_value('reference'); ?>" class="form-control" id="reference">
                </div>
                <div class="form-group">
                    <button class="btn btn-outline-danger" type="submit">NEXT</button>
                </div>
            </form>
        </div>
    </div>
</div>