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
    <link rel="stylesheet" href="<?= base_url(); ?>public/css/manager.css">
    <link rel="stylesheet" href="<?= base_url(); ?>public/datatables/media/css/dataTables.bootstrap4.css">
</head>
<body>
    <nav class="navbar navbar-dark sticky-top bg-danger navbar-expand-md mb-4">
        <div class="container">
            <a href="<?= base_url(); ?>index.php/manager" class="navbar-brand">DRICON</a>
            <buttom class="navbar-toggler" data-toggle="collapse" data-target="#adminNav">
                <span class="navbar-toggler-icon"></span>
            </buttom>
            <div class="collapse navbar-collapse" id="adminNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="<?= base_url() ?>index.php/manager/members" class="nav-link">MEMBERS</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>index.php/manager/loans" class="nav-link">LOANS</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>index.php/manager/payments" class="nav-link">PAYMENTS</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a href="<?= base_url() ?>index.php/manager/new_account" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        Settings
                        </a>
                        <div class="dropdown-menu dropdown-menu-left">
                            <a href="<?= base_url(); ?>index.php/manager/changePassword" class="dropdown-item">Password Change</a>
                            <a href="<?= base_url(); ?>index.php/manager/logout" class="dropdown-item">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <?php
            $this->load->view("$main_content"); 
        ?>
    </div>
<script src="<?= base_url(); ?>public/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url(); ?>public/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>public/dataTables/media/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>public/dataTables/media/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>public/Chart.js/dist/Chart.bundle.min.js"></script>
<script src="<?= base_url(); ?>public/Chart.js/dist/Chart.min.js"></script>
<script>
    $(document).ready(function(){
        $(".dt_table").dataTable();
        $.get('http://localhost/dricon/index.php/manager/getSummary/',function(res){
            var app = document.getElementById('applications');

            if (app != null){
                var myAppBar = new Chart(app.getContext('2d'),{
                    type: 'pie',
                    data: {
                        labels: ['Pending','Approved','Not Approved'],
                        datasets: [{
                            label: 'Application processing Summary',
                            data: [res.pending,res.approved,res.not_approved],
                            backgroundColor: [
                                'rgba(250,50,10,40)',
                                'rgba(250,80,200,40)',
                                'rgba(150,100,100,40)'
                            ]
                        }]
                    }
                })
            }
        });//end of get fun
    });
</script>
</body>
</html>