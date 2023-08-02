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
        <form action="<?= base_url(); ?>index.php/accounts/addMember" method="post">
            <div class="form-group">
                <label for="id">ID Number:</label>
                <input type="text" name="id" value="<?= set_value('id') ?>" class="form-control" id="id" placeholder="Identification Number">
            </div>
            <div class="form-group">
                <label for="fname">First Name:</label>
                <input type="text" name="fname" value="<?= set_value('fname') ?>" class="form-control" id="fname" placeholder="First Name">
            </div>
            <div class="form-group">
                <label for="lname">Last Name:</label>
                <input type="text" name="lname" value="<?= set_value('lname') ?>" class="form-control" id="lname" placeholder="Last Name">
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select name="gender" id="gender" class="form-control">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Marital Status:</label>
                <select name="status" id="status" class="form-control">
                    <option value="single">Single</option>
                    <option value="married">Married</option>
                    <option value="divorced">Divorced</option>
                    <option value="widow">Widow</option>
                </select>
            </div>
            <div class="form-group">
                <label for="occupation">Occupation:</label>
                <input type="text" value="<?= set_value('occupation') ?>" name="occupation" class="form-control" id="occupation" placeholder="Occupation">
            </div>
            <div class="form-group">
                <button class="btn btn-outline-primary" type="submit">Add</button>
            </div>
        </form>
    </div>
</div>