<?php
session_start();
include_once ("kernel/seguranca.php");
include_once ("kernel/dbconect.php");

?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/icon.png">

    <title>Dellasta Informática - Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="static/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="static/css/nav_custom.css">

    <!-- FONTS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="static/css/dashboard.css" rel="stylesheet">

    <!-- JAVASCRIPT -->
    <!--<script type="text/javascript" src="static/bootstrap/js/jquery-3.3.1.slim.min.js"></script>-->
    <script src="static/js/jquery.3.3.1.js"></script>

</head>
<body>
<!-- INICIO NAVBAR -->
<nav class="navbar navbar-dark fixed-top bg-primary flex-md-nowrap p-0 shadow-sm">
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


        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 mt-5 px-2">
            <?php
            $link = $_GET["link"];
            // DASHBOARD
            $pag['dashboard'] = "forms/dashboard/dashboard.php";


            //CADASTRO USUARIOS
            $pag['usuarios'] = "forms/cadastros/usuarios/lista_usuarios.php";
            $pag['editar-usuario'] = "forms/cadastros/usuarios/usuarios.php";
            $pag['novo-usuario'] = "forms/cadastros/usuarios/usuarios.php";
            $pag['gravar-usuario'] = "processa/cadastros/usuarios/pro_cad_usuarios.php";
            $pag['deleta-usuario'] = "processa/cadastros/usuarios/pro_cad_usuarios.php";
            $pag['deleta-multi-usuario'] = "forms/cadastros/usuarios/confirma_exclusao.php";


            //OCORRENCIAS
            $pag['ocorrencias'] = "forms/controle_ocorrencias/listar_ocorrencias.php";
            $pag['nova-ocorrencia'] = "forms/controle_ocorrencias/ocorrencias.php";
            $pag['gravar-ocorrencia'] = "processa/controle_ocorrencias/pro_cad_ocorrencias.php";



            if(!empty($link)){
                if(file_exists($pag[$link])){
                    include $pag[$link];
                }
                else{
                    //include "forms/dashboard/dashboard.php";
                    header("Location: index.php?link=dashboard");
                }
            }
            else{
                //include "forms/dashboard/dashboard.php";
                header("Location: index.php?link=dashboard");
            }
            ?>

        </main>
    </div>
</div>


<!-- Optional JavaScript -->
<script>window.jQuery || document.write('<script src="static/bootstrap/js/jquery-3.3.1.slim.min.js"><\/script>')</script>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!--<script src="static/bootstrap/js/jquery-3.3.1.slim.min.js"></script>-->
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