<div class="row">
    <div class="col-sm-12 col-md-4">
        <div class="card card-title--floating animated slideInLeft">
        <div class="card-body">
                <div class="card-title text-center bg-success"><h5>MY ACCOUNT</h5></div>
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
                <button type="button" class="btn btn-outline-success btn-sm btn-block" data-toggle="modal" data-target="#userProfile">
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
        <div class="card">
            <div class="card-body">
                <div class="card-title text-center">
                    SUMMARY
                </div>
                <div class="card-text">
                    <div class="members">
                        <h5>MEMBERS DETAILS</h5>
                        <hr>
                        <p>TOTAL ACTIVE MEMBERS: <span class="text-muted"><?= $summary['members'] ?></span></p>
                    </div>
                    <div class="loans">
                        <h5>LOAN DETAILS</h5>
                        <hr>
                        <p><span class="text-muted">TYPES OF LOAN :</span> <?= $summary['loan_type'] ?></p>
                        <p><span class="text-muted">PENDING LOANS :</span> <?= $summary['pending'] ?></p>
                        <p><span class="text-muted">APPROVED LOANS :</span> <?= $summary['approved'] ?></p>
                        <p><span class="text-muted">NOT APPROVED LOANS :</span> <?= $summary['not_approved'] ?></p>
                    </div>
                    <div class="payment">
                        <h5>APPROVED LOAN PAYMENT</h5>
                        <p>
                            <span class="text-muted">UN-CLEARED LOANS:</span>
                            <?= $summary['unpaid']; ?>
                        </p>
                        <p>
                            <span class="text-muted">CLEARED LOANS:</span>
                            <?= $summary['paid']; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <span class="text-muted"><small>&copy; Copyrights of Dricon Sacco</small></span>
            </div>
        </div>
    </div>
</div>