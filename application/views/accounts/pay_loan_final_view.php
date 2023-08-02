<div class="card">
    <div class="card-body">
        <div class="card-title text-right">REFERENCE NO: #<?= $loan['id'] ?></div>
        <div class="card-text">
            <p>
                <label for="user"><strong>Full Name: </strong><?= strtoupper($user["first_name"]." ".$user["last_name"]); ?></label>
            </p>
            <p>
                <label for="id_no"><strong>ID Number: </strong><?= $user["id_number"]; ?></label>
            </p>
            <p>
                <label for="date_taken"><strong>Date Taken: </strong> <?= $loan["date_borrowed"]; ?></label>
            </p>
            <p>
                <label for="amount_taken"><strong>Amount Taken:</strong> <?= number_format($loan["amount_borrowed"],2) ?></label>
                - <label for="amount_taken"><strong>Amount To Pay:</strong> <?= number_format($loan["amount_to_pay"],2) ?></label>
            </p>
            <div class="mt-2">
            <form action="<?= site_url("accounts/payLoanFinal"); ?>" method="post" style="max-width: 400px;">
                <div class="form-group">
                    <input type="hidden" name="identity" value="<?= $loan["id"] ?>">
                    <input type="hidden" name="identity_no" value="<?= $user["id_number"] ?>">
                    <label for="amount">Amount</label>
                    <input type="number" name="amount" min="1" class="form-control" id="amount">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-sm" type="submit">Pay</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>