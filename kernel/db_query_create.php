<?php

session_start();
$_SESSION = array();
include_once "dbconect.php";

$existTable = array();

if(isset($_POST["btn_createdb"])){
    //CADASTRO DE USUARIOS
    $result = mysqli_query($dbConect, "show tables like 'usuarios'") or die (mysqli_error($dbConect));
    $tableExist = mysqli_num_rows($result);
    if($tableExist != 1){
        $tbUsuarios = "create table usuarios(
                          userid int not null auto_increment primary key,
                          usernome varchar(250),
                          useremail varchar(200),
                          userusuario varchar(50) not null,
                          usersenha varchar(20) not null,
                          nivel_acesso integer,
                          userdatainclusao datetime,
                          userdataalteracao datetime
        )";
        mysqli_query($dbConect, $tbUsuarios) or die(mysqli_error($dbConect));
        $createadmin = mysqli_query($dbConect, "insert into usuarios( userid, usernome, useremail, userusuario, usersenha, nivel_acesso, userdatainclusao) values (1, 'Dellasta Informática', 'dellasta@dellasta.com.br', 'dellasta', '9419', '1', NOW())") or die(mysqli_error($dbConect));
        $existTable = ['Usuários: ' => 'Criado com sucesso'];
    }else{
        $existTable = ['Usuarios: ' => 'Já Existe'];
    }

    //CADASTRO DE OCORRENCIAS
    $result = mysqli_query($dbConect, "show tables like 'ocorrencias'") or die (mysqli_error($dbConect));
    $tableExist = mysqli_num_rows($result);
    if($tableExist != 1){
        $tbOcorrencias = "create table ocorrencias(
                          ocor_id int not null auto_increment primary key,
                          ocor_cliente varchar (250) not null,
                          ocor_analista integer,
                          ocor_programador integer,
                          ocor_situacao integer ,
                          ocor_solicitacao text,                                                
                          ocor_datacriacao datetime,
                          ocor_datafinalização datetime
        )";
        mysqli_query($dbConect, $tbOcorrencias) or die(mysqli_error($dbConect));
        $existTable = ['Ocorrencias: ' => 'Criado com sucesso'];
    }else{
        $existTable = ['Ocorrencias: ' => 'Já Existe'];
    }

    //COMENTARIOS DAS OCORRENCIAS
    $result = mysqli_query($dbConect, "show tables like 'ocorrencias_comentarios'") or die (mysqli_error($dbConect));
    $tableExist = mysqli_num_rows($result);
    if($tableExist != 1){
        $tbOcorComentarios = "create table ocorrencias_comentarios(
                          coment_id int not null auto_increment primary key,
                          coment_ocor_id integer ,
                          coment_comentario text,
                          coment_data_comentario datetime,
                          coment_user_id integer ,
                          
                          
        )";
        mysqli_query($dbConect, $tbOcorComentarios) or die(mysqli_error($dbConect));
        $existTable = ['Comentarios de Ocorrencias: ' => 'Criado com sucesso'];
    }else{
        $existTable = ['Comentarios de Ocorrencias: ' => 'Já Existe'];
    }

    // MENSAGENS DE ERRO NA CRIACAO
    //no textarea html
}




//var_dump($_POST);
unset($_POST);
session_destroy();
?>


<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../static/bootstrap/css/bootstrap.min.css">

    <title>Hello, world!</title>
</head>
<body>
<div class="container">
    <h1>Pagina de Criação das tabelas do Banco de Dados do Sistema Controle da Dellasta Informática</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" novalidate="novalidate">
        <input class="btn btn-lg btn-primary" type="submit" name="btn_createdb" value="Criar">
        <br>
        <textarea class="form-control-plaintext font-weight-bold" rows="10" cols="10">
            <?php
                foreach ($existTable as $indice => $valor){
                    echo $indice, $valor."\n";
                }
            ?>
        </textarea>
    </form>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../static/bootstrap/js/jquery-3.3.1.slim.min.js"></script>
<script src="../static/bootstrap/js/popper.min.js"></script>
<script src="../static/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>