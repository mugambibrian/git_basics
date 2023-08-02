<div class="card animated slideInUp signForm">
    <div class="card-body">
        <?php if (isset($message) && $message != null): ?>
            <div class="alert <?= $type; ?>">
                <p><?= $message; ?></p>
            </div>
        <?php endif; ?>
        <?php if (validation_errors() != null): ?>
            <div class="alert alert-danger">
                <?= validation_errors(); ?>
            </div>
        <?php endif; ?>
        <form action="<?= base_url(); ?>index.php/admin/changePass" method="post">
            <div class="form-group">
                <label for="current">Current Password</label>
                <input type="password" name="current" placeholder="Current Password" class="form-control" id="current">
            </div>
            <div class="form-group">
                <label for="new">New Password</label>
                <input type="password" name="new" placeholder="New Password" class="form-control" id="new">
            </div>
            <div class="form-group">
                <label for="confirm">Confirm Password</label>
                <input type="password" name="confirm" placeholder="Confirm Password" class="form-control" id="confirm">
            </div>
            <div class="form-group">
                <button class="btn btn-outline-primary" type="submit">Change Password</button>
            </div>
        </form>
    </div>
</div>