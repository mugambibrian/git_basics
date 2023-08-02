<div class="card mt-5 animated slideInLeft">
    <div class="card-body">
        <?php if (validation_errors() != null): ?>
        <div class="text-center alert alert-danger signForm">
            <?= validation_errors(); ?>
        </div>
        <?php endif; ?>
        <div class="signForm">
            <form action="<?= base_url(); ?>index.php/admin/postNewStaff" method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" value="<?= set_value('username'); ?>" placeholder="Username" class="form-control" id="username">
                </div>
                <div class="form-group">
                    <label for="fname">First Name:</label>
                    <input type="text" name="fname" value="<?= set_value('fname'); ?>" placeholder="First Name" class="form-control" id="fname">
                </div>
                <div class="form-group">
                    <label for="lname">Last Name:</label>
                    <input type="text" name="lname" value="<?= set_value('lname'); ?>" placeholder="Last Name" class="form-control" id="lname">
                </div>
                <div class="form-group">
                    <label for="userlevel">Userlevel:</label>
                    <select name="userlevel" id="userlevel" class="form-control">
                        <option value="Admin">Admin</option>
                        <option value="Manager">Manager</option>
                        <option value="Accounts">Accountant</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="New Password" id="password">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type=""submit>Add New</button>
                </div>
            </form>
        </div>
    </div>
</div>