<div class="row">
    <div class="col-md-4">
        <div class="card card-title--floating animated slideInLeft">
            <div class="card-body">
                <div class="card-title text-center bg-success"><h5>MY ACCOUNT</h5></div>
                <div class="card-text">
                    <p>
                        <label for="username"><span class="text-muted">Username:</span></label>
                        <span class="float-right"><?= $user["username"] ?></span>
                    </p>
                    <p>
                        <label for="fullname"><span class="text-muted">Full Name:</span></label>
                        <span class="float-right"><?= strtoupper($user["first_name"]." ".$user["last_name"]) ?></span>
                    </p>
                    <p>
                        <label for="userlevel"><span class="text-muted">Userlevel:</span></label>
                        <span class="float-right"><?= $user["userlevel"] ?></span>
                    </p>
                </div>
                <button class="btn btn-sm btn-outline-success btn-block">View Profile</button>
            </div>
            <div class="card-footer">
                <span class="text-muted"><small>Last Login: 23-05-2018 10:45</small></span>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-8">
        <div class="card animated slideInDown">
            <div class="card-body">
                <div class="card-title text-center lead">STAFF SUMMARY</div><hr>
                <div class="card-text">
                    <p class="text-success"><strong>Active Staff</strong></p>
                    <ul class="list-group list-unstyled">
                        <li>
                            <span class="text-muted">Admins:</span> 
                            <span class="float-right"><?= $staffs["activeAdmins"] ?></span>
                        </li>
                        <li>
                            <span class="text-muted">Managers:</span>
                            <span class="float-right"><?= $staffs["activeManagers"] ?></span>
                        </li>
                        <li>
                            <span class="text-muted">Accounts:</span>
                            <span class="float-right"><?= $staffs["activeAccounts"] ?></span>
                        </li>
                    </ul>
                    <br><hr>
                    <p class="text-danger"><strong>Inactive Staff</strong></p>
                    <ul class="list-group list-unstyled">
                        <li>
                            <span class="text-muted">Suspended Accounts:</span> 
                            <span class="float-right"><?= $staffs["suspended"] ?></span>
                        </li>
                        <li>
                            <span class="text-muted">Retired Staff:</span>
                            <span class="float-right"><?= $staffs["retired"] ?></span>
                        </li>
                        <li>
                            <span class="text-muted">Dismissed Staff:</span>
                            <span class="float-right"><?= $staffs["dismissed"] ?></span>
                        </li>
                    </ul>
                    <hr><hr>
                    <p class="text-right">Total Staff: <strong><?= $staffs["total"] ?></strong></p>
                </div>
                
            </div>
        </div>
    </div>
</div>