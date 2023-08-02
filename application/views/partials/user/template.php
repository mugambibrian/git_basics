<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dricon</title>
    <link rel="stylesheet" href="<?= base_url(); ?>public/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>public/animate.css/animate.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>public/css/common.css">
    <link rel="stylesheet" href="<?= base_url(); ?>public/css/home.css">
</head>
<body>
    <?php
        $this->load->view("$main_content"); 
    ?>
<script src="<?= base_url(); ?>public/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url(); ?>public/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>