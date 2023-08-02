<div class="row">
    <div class="col-sm-12 col-md-4">
        <div class="card card-title--floating animated slideInLeft">
            <div class="card-body">
                <div class="card-title text-center bg-danger"><h5>MY ACCOUNT</h5></div>
                <div class="card-text">
                    <p>
                        <label for="username"><span class="text-muted">Username:</span></label>
                        <span class="float-right"><?= strtolower($user["username"]); ?></span>
                    </p>
                    <p>
                        <label for="fullname"><span class="text-muted">Full Name:</span></label>
                        <span class="float-right"><?= strtoupper($user["first_name"]." ".$user["last_name"]); ?></span>
                    </p>
                    <p>
                        <label for="userlevel"><span class="text-muted">Userlevel:</span></label>
                        <span class="float-right"><?= $user["userlevel"]; ?></span>
                    </p>
                </div>
                <button type="button" class="btn btn-outline-danger btn-sm btn-block" data-toggle="modal" data-target="#userProfile">
                    View Profile
                </button>
            </div>
            <div class="card-footer">
                <span class="text-muted">
                    <small>Last Login:
                        <?php
                            if ($user["last_login"] != null)
                                echo $user["last_login"];
                            else
                                echo "Never logged in";
                        ?>
                    </small>
                </span>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-8">
        <div class="card-deck">
            <div class="card card-title--floating animated slideInDown">
                <div class="card-body">
                    <div class="card-title bg-dark">MEMBERS</div>
                    <div class="card-text">
                        <p>New Members <span class="badge badge-danger"><?= $sum['new_members']; ?></span></p>
                        <p>Total Members <span class="badge badge-warning"><?= $sum['all_members']; ?></span></p>
                    </div>
                </div>
            </div>
            <div class="card card-title--floating animated slideInRight">
                <div class="card-body">
                    <div class="card-title bg-dark">LOANS</div>
                    <div class="card-text">
                        <p>New Applications <span class="badge badge-danger"><?= $sum['pending']; ?></span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3 animated slideInDown">
            <div class="card-body">
                <div class="card-title">APPLICATIONS SUMMARY</div><hr>
                <div class="card-text">
                    <canvas id="applications"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<!--user profile-->
<div class="modal fade" id="userProfile" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title lead">USER PROFILE</div>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <label for="username">Username: </label>
                <input type="text" value="<?= strtolower($user['username']) ?>" readonly class="form-control" id="username">
                <label for="fname">First Name: </label>
                <input type="text" value="<?= strtoupper($user['first_name']) ?>" readonly class="form-control" id="fname">
                <label for="lname">Last Name: </label>
                <input type="text" value="<?= strtoupper($user['last_name']) ?>" readonly class="form-control" id="lname">
                <label for="userlevel">Userlevel: </label>
                <input type="text" value="<?= $user['userlevel'] ?>" readonly class="form-control" id="userlevel">
            </div>
            <div class="modal-footer text-muted">
                <p class="text-center">&copy; Copyright of Dricon Management</p>
            </div>
        </div>
    </div>
</div>