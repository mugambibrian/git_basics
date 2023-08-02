<?php if (isset($message) && $message != null): ?>
    <div class="alert alert-<?= $type; ?>">
        <button class="close" type="button" data-dismiss="alert">&times;</button>
        <p><?= $message; ?></p>
    </div>
<?php endif; ?>
<div class="card">
    <div class="card-body">
        
        <div class="card-text text-right">
            <a href="<?= base_url(); ?>index.php/accounts/add_member" class="btn btn-outline-success btn-sm">Add New Member</a>
        </div>
    </div>
</div>
<div class="table-responsive mt-2">
    <table class="table table-striped table-hover dt_table">
        <thead>
            <tr>
                <th>ID NUMBER</th>
                <th>FIRST NAME</th>
                <th>LAST NAME</th>
                <th>APPROVED</th>
                <th>CHANGE</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($users as $user): ?>
            <tr>
                <td><?= $user["id_number"]; ?></td>
                <td><?= $user["first_name"]; ?></td>
                <td><?= $user["last_name"]; ?></td>
                <td><?= $user["status"]; ?></td>
                <td><a href="<?= site_url("accounts/editUser/").$user['id']; ?>" class="btn btn-sm btn-outline-success">Edit</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>