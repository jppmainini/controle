<?php
ob_start();
if(($_SESSION["usernome"] == "") || ($_SESSION["userusuario"] == "") || ($_SESSION["usernivel"] == "")){
    unset(
        $_SESSION["usernome"],
        $_SESSION["userusuario"],
        $_SESSION["usernivel"]
    );
    $_SESSION["loginerro"] = "<div class=\"alert alert-danger\" role=\"alert\">
                                Área Restrita, Somente para Usuários Cadastrados.
                              </div>";
    header("Location: login.php");
}