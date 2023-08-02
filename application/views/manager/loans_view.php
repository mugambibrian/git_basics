<div class="table-responsive animated slideInDown">
    <table class="table table-hover table-striped dt_table">
        <thead>
            <tr>
                <th>REF_NO</th>
                <th>ID NO</th>
                <th>NAME</th>
                <th>AMOUNT</th>
                <th>INTEREST</th>
                <th>STATUS</th>
                <tH>VIEW</tH>
            </tr>
        </thead>
        <tbody>
        <?php foreach($loans as $loan): ?>
            <tr>
                <td><?= $loan["id"] ?></td>
                <td><?= $loan["id_number"] ?></td>
                <td><?= $loan["first_name"]." ".$loan["last_name"] ?></td>
                <td><?= $loan["amount_borrowed"] ?></td>
                <td><?= $loan["interest"] ?>%</td>
                <?php
                    $status = $loan['status'];
                    if ($status == 'pending')
                        $text = "primary";
                    elseif($status == "approved")
                        $text = "success";
                    else
                        $text = "danger";
                ?>
                <td class="text-<?= $text ?>"><?= $status ?></td>
                <td>
                    <a href="<?= site_url('manager/viewLoan/'.$loan["id"]) ?>" class="btn btn-sm btn-outline-dark">view</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>