<?php
ob_start();
if(($_SESSION["usuarionome"] == "") || ($_SESSION["usuariousuario"] == "")){
    unset(
        $_SESSION["usuarionome"],
        $_SESSION["usuariousuario"]
    );
    $_SESSION["login_erro"] = "<div class=\"alert alert-danger\" role=\"alert\">
                                Área Restrita, Somente para Usuários Cadastrados.
                              </div>";
    header("Location: login.php");
    //var_dump($_SESSION);
}