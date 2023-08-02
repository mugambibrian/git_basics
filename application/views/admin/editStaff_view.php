<div class="card mt-5 animated slideInLeft">
    <div class="card-body">
        <div class="signForm">
            <?php if (validation_errors() != null): ?>
                <div class="alert alert-danger">
                    <?= validation_errors() ?>
                </div>
            <?php endif; ?>
            <p class="text-danger">
                <small>
                    if you don't want to change the password leave it blank please
                </small>
            </p>
            <form action="<?= base_url(); ?>index.php/admin/editUser" method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text"  value="<?= $username; ?>" class="form-control" readonly>
                    <input type="hidden" name="id" value="<?= $user_id; ?>" >
                </div>
                <div class="form-group">
                    <label for="fname">First Name:</label>
                    <input type="text" placeholder="First Name" name="fname" value="<?= set_value("fname",$fname); ?>" class="form-control" id="fname">
                </div>
                <div class="form-group">
                    <label for="lname">Last Name:</label>
                    <input type="text" placeholder="Last Name" name="lname" value="<?= set_value("lname", $lname); ?>" class="form-control" id="lname">
                </div>
                <div class="form-group">
                    <label for="userlevel">Userlevel:</label>
                    <?php
                        $options = array(
                            "Admin" => "Admin",
                            "Manager" => "Manager",
                            "Accounts" => "Accountant"
                        );
                    ?>
                    <?= form_dropdown("userlevel",$options,$userlevel,'class="form-control"'); ?>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" placeholder="Leave the field blank if don't want to chande" name="password" class="form-control" id="password">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type=""submit>Update</button>
                </div>
            </form>
        </div>
    </div>
</div>