<div class="card animated slideInDown mt-3">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover dt_table">
                <thead>
                    <tr>
                        <th width="30%">USERNAME</th>
                        <th width="40%">NAME</th>
                        <th width="20%">USERLEVEL</th>
                        <th width="10%">MANAGE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($staffs as $staff): ?>
                    <tr>
                        <td><?= strtolower($staff["username"]); ?></td>
                        <td><?= strtoupper($staff["first_name"]." ".$staff["last_name"]); ?></td>
                        <td><?= $staff["userlevel"] ?></td>
                        <td>
                            <a href="<?= base_url('index.php/admin/edit/').$staff['id']; ?>" class="btn btn-sm btn-outline-primary">
                                edit
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>