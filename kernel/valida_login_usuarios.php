<?php
session_start();
include_once "dbconect.php";

var_dump($_POST);
var_dump($_SESSION);


if(isset($_POST['btn_login'])){
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $empresa = $_POST['empresa'];

// BUSCA EMPRESA


//VERIFICA USUARIO CADASTRADO
    $result = mysqli_query($dbConect, "select * from usuarios where userusuario = '$usuario' and usersenha = '$senha' limit 1");
    $resultado = mysqli_fetch_assoc($result);

    if(empty($resultado)){
        $_SESSION['login_erro'] = "<div class=\"alert alert-danger\" role=\"alert\">Usuário ou Senha Inválidos</div>";
        header("Location: ../login.php");
    }else{
        //DEFINE VALORES ATRIBUIDOS NA SESSAO DO USUARIO
        $_SESSION['userid'] = $resultado['userid'] ;
        $_SESSION['usuarionome'] = $resultado['usernome'] ;
        $_SESSION['usuariousuario'] = $resultado['userusuario'] ;

        header("Location: ../index.php");
    }






}
