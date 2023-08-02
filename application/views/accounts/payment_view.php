<div class="table-responsive animated slideInLeft">
    <table class="table table-hover table-striped dt_table">
        <thead>
            <tr>
                <th>REFERENCE</th>
                <th>ID</th>
                <th>NAME</th>
                <th>AMOUNT</th>
                <th>VIEW</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($loans as $loan): ?>
            <tr>
                <td><?= $loan['id']; ?></td>
                <td><?= $loan['id_number']; ?></td>
                <td><?= $loan['first_name'].' '.$loan['last_name'] ?></td>
                <td><?= $loan['amount_borrowed'] ?></td>
                <td>
                    <a href="<?= base_url(); ?>index.php/accounts/loan_details/<?= $loan['id']; ?>" class="btn btn-sm btn-outline-primary">view</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>