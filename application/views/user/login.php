<div class="signForm mt-3">
<?php if (validation_errors() != null): ?>
    <div class="alert alert-danger animated shake">
        <?= validation_errors(); ?>
    </div>
<?php endif; ?>
<?php
    if (isset($message) && $message != null){
        echo $message;
    }
?>
</div>
<div class="card signForm mt-5 animated slideInDown card-title--floating">
    <div class="card-body">
        <div class="card-title text-center bg-success m-0">LOGIN FORM</div>
        <form action="<?= base_url(); ?>index.php/home/login" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" placeholder="Username" name="username" value="<?= set_value('username') ?>" class="form-control" id="username">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" placeholder="Password" name="password" class="form-control" id="password">
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Login</button>
            </div>
        </form>
    </div>
</div>