<?php
session_start();
include_once ("kernel/seguranca.php");
include_once ("kernel/dbconect.php");

?>

<!doctype html>
<html lang="pt-br">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="static/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="static/css/dashboard.css">
    <link rel="stylesheet" href="static/css/float-label.css">

    <title><?php echo $pagina." | "?>Dellasta Informática</title>
</head>
<body>
<!-- INICIO NAVBAR -->
<nav class="navbar navbar-dark fixed-top bg-primary
 flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#"><?php echo $_SESSION['usuarionome']?><br>
        <h6 class="badge m-md-0 "><?php echo $_SESSION['usuariousuario']?></h6>
    </a>

    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link text-white" href="sair.php"><i class="fas fa-power-off fa-lg"></i></a>
        </li>
    </ul>
</nav>
<!--  -->

<!-- INICIO CORPO -->
<div class="container-fluid ">
    <div class="row">
        <!-- INICIO NAVBAR -->
        <?php include_once ('navmenulateral.php')?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-2">
            <?php
            $link = $_GET["link"];
            // DASHBOARD
            $pag[1] = "dashboard.php";

            if(!empty($link)){
                if(file_exists($pag[$link])){
                    include $pag[$link];
                }
                else{
                    include "dashboard.php";
                }
            }
            else{
                include "dashboard.php";
            }
            ?>

        </main>
    </div>
</div>


<!-- Optional JavaScript -->
<script>window.jQuery || document.write('<script src="static/bootstrap/js/jquery-3.3.1.slim.min.js"><\/script>')</script>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="static/bootstrap/js/jquery-3.3.1.slim.min.js"></script>
<script src="static/bootstrap/js/popper.min.js"></script>
<script src="static/bootstrap/js/bootstrap.min.js"></script>

<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
    feather.replace()
</script>

<!-- Graphs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>

</body>
</html>