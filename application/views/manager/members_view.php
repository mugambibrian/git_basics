<ul class="nav nav-tabs mb-3">
    <li class="nav-item">
        <a href="#newMembers" class="nav-link active" data-toggle="tab">New Members</a>
    </li>
    <li class="nav-item">
        <a href="#allMembers" class="nav-link" data-toggle="tab">All Members</a>
    </li>
</ul>
<div class="tab-content">
    <div class="tab-pane active show" id="newMembers">  
        <div class="table-responsive animated slideInRight">
            <table class="table table-striped table-hover dt_table">
                <thead>
                    <tr>
                        <th>ID NO</th>
                        <th>NAME</th>
                        <th>OCCUPATION</th>
                        <th width="20%">MANAGE</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($members as $member): ?>
                    <tr>
                        <td><?= $member["id_number"] ?></td>
                        <td><?= $member["first_name"]." ".$member["last_name"] ?></td>
                        <td><?= $member["occupation"] ?></td>
                        <td>
                            <a href="<?= site_url('manager/approveMember/'.$member['id']); ?>" class="btn btn-outline-success btn-sm">Approve</a>
                            <a href="<?= site_url('manager/disapproveMember/'.$member['id']); ?>" class="btn btn-sm btn-outline-danger">Disapprove</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="tab-pane" id="allMembers">
        <div class="table-responsive animated slideInLeft">
            <table class="table table-striped table-hover dt_table">
                <thead>
                    <tr>
                        <th>ID NO</th>
                        <th>NAME</th>
                        <th>OCCUPATION</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($mems as $mem): ?>
                    <tr>
                        <td><?= $mem["id_number"] ?></td>
                        <td><?= $mem["first_name"]." ".$mem["last_name"] ?></td>
                        <td><?= $mem["occupation"] ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>