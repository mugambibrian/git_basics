<div class="card signForm">
    <div class="card-body">
        <?php if (isset($message) && $message != null): ?>
            <div class="alert alert-<?= $type; ?>">
                <p><?= $message; ?></p>
            </div>
        <?php endif; ?>
        <?php if (validation_errors() != null): ?>
            <div class="alert alert-danger">
                <?= validation_errors(); ?>
            </div>
        <?php endif; ?>
        <form action="<?= base_url(); ?>index.php/accounts/editMember" method="post">
            <div class="form-group">
                <input type="hidden" name="mem_id" value="<?= $user["id"]; ?>">
            </div>
            <div class="form-group">
                <label for="id">ID Number:</label>
                <input type="text" name="id" value="<?= set_value('id',$user["id_number"]) ?>" class="form-control" id="id" placeholder="Identification Number">
            </div>
            <div class="form-group">
                <label for="fname">First Name:</label>
                <input type="text" name="fname" value="<?= set_value('fname',$user["first_name"]) ?>" class="form-control" id="fname" placeholder="First Name">
            </div>
            <div class="form-group">
                <label for="lname">Last Name:</label>
                <input type="text" name="lname" value="<?= set_value('lname',$user["last_name"]) ?>" class="form-control" id="lname" placeholder="Last Name">
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <?php
                    $gender = array(
                        "male" => "Male",
                        "female" => "Female",
                        "other" => "Other"
                    );
                    echo form_dropdown("gender",$gender,$user["gender"],'class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <label for="status">Marital Status:</label>
                <?php
                    $status = array(
                        "single" => "Single",
                        "married" => "Married",
                        "divorced" => "Divorced",
                        "widow" => "Widow"
                    );
                    echo form_dropdown("status",$status,$user["status"],'class="form-control"');
                ?>
            </div>
            <div class="form-group">
                <label for="occupation">Occupation:</label>
                <input type="text" value="<?= set_value('occupation',$user["occupation"]) ?>" name="occupation" class="form-control" id="occupation" placeholder="Occupation">
            </div>
            <div class="form-group">
                <button class="btn btn-outline-success" type="submit">Update</button>
            </div>
        </form>
    </div>
</div>